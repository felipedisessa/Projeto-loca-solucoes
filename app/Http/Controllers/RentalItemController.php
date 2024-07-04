<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RentalItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-or-landlord');

        $rentalItems = RentalItem::query()->orderBy('created_at', 'desc')->paginate(20);
        $search      = request('search');

        if ($search) {
            $rentalItems = RentalItem::query()->where('name', 'like', '%' . $search . '%')->paginate(20);
        }

        if ($rentalItems->isEmpty()) {
            // Redireciona de volta ao index se nao existir nenhum item
            return redirect()->route('rental-items.index');
        }

        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.index', compact('rentalItems', 'landLordUsers'));
    }

    public function create()
    {
        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.modal.create', compact('landLordUsers'));
    }

    public function store(Request $request)
    {
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

        try {
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
        } catch (\Exception $e) {
            return redirect()->route('rental-items.index')->with('error', $e->getMessage());
        }
    }

    public function show(RentalItem $rentalItem)
    {
        return view('rental-items.show', compact('rentalItem'));
    }

    public function destroy(RentalItem $rentalItem)
    {
        $rentalItem->delete();

        return redirect()->route('rental-items.index');
    }

    public function edit(RentalItem $rentalItem)
    {
        $rentalItem = RentalItem::with('address')->findOrFail($rentalItem->id);

        return response()->json($rentalItem);
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $rentalItemUpdated = $request->all();
        $rentalItem->update($rentalItemUpdated);

        $addressData = $request->all();
        $rentalItem->address()->updateOrCreate(['rental_item_id' => $rentalItem->id], $addressData);

        return redirect()->route('rental-items.index');
    }
}
