<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RentalItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-or-landlord');

        $rentalItemsQuery = RentalItem::query()->orderBy('created_at', 'desc')->paginate(20);
        $search           = request('search');

        if ($search) {
            $rentalItemsQuery = RentalItem::query()->where('name', 'like', '%' . $search . '%')->paginate(20);
        }

        $rentalItems = $rentalItemsQuery;

        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.index', compact('rentalItems', 'landLordUsers'));
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
        ]);

        // Formatar os preços removendo vírgulas e o símbolo "R$"
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

        return view(
            'rental-items.show',
            compact('rentalItem', 'averageReservesPerMonth', 'totalReserves', 'totalRevenue')
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
        $rentalItem = RentalItem::with('address')->findOrFail($rentalItem->id);

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
        ]);

        $pricePerHour  = preg_replace('/[^0-9]/', '', $request->price_per_hour)  / 100;
        $pricePerDay   = preg_replace('/[^0-9]/', '', $request->price_per_day)   / 100;
        $pricePerMonth = preg_replace('/[^0-9]/', '', $request->price_per_month) / 100;

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

        return redirect()->route('rental-items.index');
    }
}
