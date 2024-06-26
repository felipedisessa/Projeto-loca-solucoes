<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        $reserves = Reserve::query()->orderBy('created_at', 'desc')->paginate(20);
        $search   = request('search');

        if ($search) {
            $reserves = Reserve::query()->where('title', 'like', '%' . $search . '%')->paginate(20);
        }

        $bookUsers = User::query()->where('role', 'visitor')->get();
        $bookItems = RentalItem::query()->get();

        return view('reserves.index', compact('reserves', 'search', 'bookUsers', 'bookItems'));
    }

    public function store(Request $request)
    {
        Reserve::query()->create([
            'user_id'        => $request->user_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'start'          => $request->start,
            'end'            => $request->end,
            'rental_item_id' => $request->rental_item_id,
            'status'         => $request->status,
            'price'          => $request->price,
            'payment_type'   => $request->payment_type,
        ]);

        return back();
    }

    public function create()
    {
        $bookUsers = User::query()->where('role', 'visitor')->get();
        $bookItems = RentalItem::query()->get();

        return view('reserves.modal.create', compact('bookUsers', 'bookItems'));
    }

    public function show($id)
    {
        $reserve = Reserve::findOrFail($id);

        return view('reserves.show', compact('reserve'));
    }

    public function destroy($id)
    {
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();

        return redirect()->route('reserves.index');
    }

    public function edit($id)
    {
        $bookUsers = User::query()->where('role', 'visitor')->get();
        $bookItems = RentalItem::query()->get();
        $reserve   = Reserve::findOrFail($id);

        return response()->json($reserve);

        return view('reserves.edit', compact('reserve', 'bookUsers', 'bookItems'));
    }

    public function update(Request $request, $reserf)
    {
        $reserve = Reserve::findOrFail($reserf);
        $reserve->update([
            'user_id'        => $request->user_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'start'          => $request->start,
            'end'            => $request->end,
            'rental_item_id' => $request->rental_item_id,
            'status'         => $request->status,
            'price'          => $request->price,
            'payment_type'   => $request->payment_type,
        ]);

        return redirect()->route('reserves.index');
    }

    public function getReservesJson()
    {
        $reserves = Reserve::all();

        $events = $reserves->map(function($reserve) {
            return [
                'user_id'       => $reserve->user_id,
                'id'            => $reserve->id,
                'title'         => $reserve->title,
                'start'         => $reserve->start,
                'end'           => $reserve->end,
                'price'         => $reserve->price,
                'description'   => $reserve->description,
                'status'        => $reserve->status,
                'payment_type'  => $reserve->payment_type,
                'extendedProps' => [
                    'user_id'        => $reserve->user_id,
                    'rental_item_id' => $reserve->rental_item_id,
                    'description'    => $reserve->description,
                    'status'         => $reserve->status,
                    'start'          => $reserve->start,
                    'end'            => $reserve->end,
                    'price'          => $reserve->price,
                    'payment_type'   => $reserve->payment_type,
                ],
            ];
        });

        return response()->json($events);
    }
}
