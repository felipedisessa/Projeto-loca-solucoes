<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Http\Request;

class RentalItemController extends Controller
{
    public function index()
    {
        $rentalItems = RentalItem::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('rental-items.index', compact('rentalItems'));
    }

    public function create()
    {
        $landLordUsers = User::query()->where('role', 'landlord')->get();

        return view('rental-items.create', compact('landLordUsers'));
    }

    public function store(Request $request)
    {
        $RentalItem = RentalItem::query()->create([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'price_per_hour'    => $request->price_per_hour,
            'price_per_day'     => $request->price_per_day,
            'price_per_month'   => $request->price_per_month,
            'status'            => $request->status,
            'rental_item_notes' => $request->rental_item_notes,
        ]);
        Address::query()->create([
            'rental_item_id' => $RentalItem->id,
            'street'         => $request->street,
            'number'         => $request->number,
            'complement'     => $request->complement,
            'neighborhood'   => $request->neighborhood,
            'city'           => $request->city,
            'state'          => $request->state,
            'zipcode'        => $request->zipcode,
            'country'        => $request->country,
        ]);

        return back();
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
        $landLordUsers = User::query()->where('role', 'landlord')->get();


        return view('rental-items.edit', compact('rentalItem', 'landLordUsers'));
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $rentalItemUpdated = $request->all();
        $rentalItem->update($rentalItemUpdated);

        return redirect()->route('rental-items.index');
    }
}
