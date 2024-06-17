<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function store(Request $request)
    {
        Address::query()->create([
            'user_id'        => $request->user_id,
            'rental_item_id' => $request->rental_item_id,
            'street'         => $request->street,
            'number'         => $request->number,
            'complement'     => $request->complement,
            'neighborhood'   => $request->neighborhood,
            'city'           => $request->city,
            'state'          => $request->state,
            'zipcode'        => $request->zipcode,
            'country'        => $request->country,
        ]);
    }

    public function create()
    {
        return view('addresses.create');
    }

}
