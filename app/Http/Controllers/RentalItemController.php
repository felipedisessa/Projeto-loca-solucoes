<?php

namespace App\Http\Controllers;

use App\Enum\RentalItemEnum;
use App\Models\Address;
use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-or-landlord');
        $statusOptions    = RentalItemEnum::options();
        $rentalItemsQuery = RentalItem::query()->orderBy('created_at', 'desc')->paginate(20);
        $search           = request('search');
        $upload           = request('upload');

        if ($search) {
            $rentalItemsQuery = RentalItem::query()->where('name', 'like', '%' . $search . '%')->paginate(20);
        }

        $rentalItems = $rentalItemsQuery;

        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.index', compact('rentalItems', 'landLordUsers', 'statusOptions', 'search', 'upload'));
    }

    public function create()
    {
        $this->authorize('admin-or-landlord');
        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.modal.create', compact('landLordUsers'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin-or-landlord');

        $validatedData = $request->validate([
            'user_id'      => 'required',
            'name'         => 'required',
            'description'  => 'required',
            'status'       => 'required',
            'street'       => 'required',
            'number'       => 'required|numeric',
            'neighborhood' => 'required',
            'city'         => 'required',
            'state'        => 'required',
            'zipcode'      => 'required|numeric',
            'country'      => 'required',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pricePerHour  = str_replace(['R$', ','], '', $request->price_per_hour);
        $pricePerDay   = str_replace(['R$', ','], '', $request->price_per_day);
        $pricePerMonth = str_replace(['R$', ','], '', $request->price_per_month);

        $rentalItem = RentalItem::create([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'price_per_hour'    => $pricePerHour,
            'price_per_day'     => $pricePerDay,
            'price_per_month'   => $pricePerMonth,
            'status'            => $request->status,
            'rental_item_notes' => $request->rental_item_notes,
        ]);

        Address::create([
            'rental_item_id' => $rentalItem->id,
            'street'         => $request->street,
            'number'         => $request->number,
            'complement'     => $request->complement,
            'neighborhood'   => $request->neighborhood,
            'city'           => $request->city,
            'state'          => $request->state,
            'zipcode'        => $request->zipcode,
            'country'        => $request->country,
        ]);

        if ($request->hasFile('rental_item_image')) {
            $image     = $request->file('rental_item_image');
            $path      = $image->store('uploads');
            $imageName = $image->getClientOriginalName();

            $rentalItem->uploads()->create([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('rental-items.index')->with('success', 'Item de locação criado com sucesso!');
    }

    public function show(RentalItem $rentalItem)
    {
        $this->authorize('admin-or-landlord');

        $monthlyReserves = Reserve::selectRaw('YEAR(start) as year, MONTH(start) as month, COUNT(*) as total')
            ->where('rental_item_id', $rentalItem->id)
            ->groupBy('year', 'month')
            ->get();

        $averageReservesPerMonth = $monthlyReserves->avg('total');

        $totalReserves = Reserve::where('rental_item_id', $rentalItem->id)->where('status', 'confirmed')->count();

        $totalRevenue = Reserve::where('rental_item_id', $rentalItem->id)->where(
            'status',
            '!=',
            'cancelled'
        )->sum('price');

        // Obter o label do status em português
        $statusLabel = RentalItemEnum::from($rentalItem->status)->label();

        $rentalItem->load('uploads');

        return view(
            'rental-items.show',
            compact('rentalItem', 'averageReservesPerMonth', 'totalReserves', 'totalRevenue', 'statusLabel')
        );
    }

    public function destroy(RentalItem $rentalItem)
    {
        $this->authorize('admin-or-landlord');
        $rentalItem->delete();

        return redirect()->route('rental-items.index');
    }

    public function edit(RentalItem $rentalItem)
    {
        $this->authorize('admin-or-landlord');
        $rentalItem = RentalItem::with(['address', 'uploads'])->findOrFail($rentalItem->id);

        return response()->json($rentalItem);
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $this->authorize('admin-or-landlord');

        $validatedData = $request->validate([
            'user_id'         => 'required',
            'name'            => 'required',
            'description'     => 'required',
            'status'          => 'required',
            'street'          => 'required',
            'number'          => 'required|numeric',
            'neighborhood'    => 'required',
            'city'            => 'required',
            'state'           => 'required',
            'zipcode'         => 'required|numeric',
            'country'         => 'required',
            'price_per_hour'  => 'required',
            'price_per_day'   => 'required',
            'price_per_month' => 'required',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação do arquivo de imagem
        ]);

        $pricePerHour  = (float) str_replace(['R$', ','], '', $request->price_per_hour)  / 100;
        $pricePerDay   = (float) str_replace(['R$', ','], '', $request->price_per_day)   / 100;
        $pricePerMonth = (float) str_replace(['R$', ','], '', $request->price_per_month) / 100;

        $rentalItem->update([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'status'            => $request->status,
            'price_per_hour'    => $pricePerHour,
            'price_per_day'     => $pricePerDay,
            'price_per_month'   => $pricePerMonth,
            'rental_item_notes' => $request->rental_item_notes,
        ]);

        $addressData = $request->only([
            'country', 'zipcode', 'state', 'city', 'neighborhood', 'street', 'number', 'complement',
        ]);
        $rentalItem->address()->updateOrCreate(['rental_item_id' => $rentalItem->id], $addressData);

        if ($request->hasFile('rental_item_image')) {
            if ($rentalItem->uploads()->exists()) {
                $oldImage = $rentalItem->uploads()->first();
                Storage::delete($oldImage->file_path);
                $oldImage->delete();
            }

            $image     = $request->file('rental_item_image');
            $path      = $image->store('uploads');
            $imageName = $image->getClientOriginalName();

            $rentalItem->uploads()->create([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('rental-items.index');
    }

    public function deleteImage(RentalItem $rentalItem)
    {
        $this->authorize('admin-or-landlord');

        if ($rentalItem->uploads()->exists()) {
            $image = $rentalItem->uploads()->first();
            Storage::delete($image->file_path);
            $image->delete();
        }

        return response()->json(['success' => 'Imagem excluída com sucesso!']);
    }
}
