<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('admin-or-landlord');

        $reserves = Reserve::query()->orderBy('created_at', 'desc')->paginate(20);
        $search   = request('search');

        if ($search) {
            $reserves = Reserve::query()->where('title', 'like', '%' . $search . '%')->paginate(20);
        }

        if ($reserves->isEmpty()) {
            // Redireciona de volta ao index se nao existir nenhum usuario
            return redirect()->route('users.index');
        }

        $bookUsers = User::query()->where('role', 'visitor')->get();
        $bookItems = RentalItem::query()->get();

        return view('reserves.index', compact('reserves', 'search', 'bookUsers', 'bookItems'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'        => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'start'          => 'required',
            'end'            => 'required',
            'rental_item_id' => 'required',
            'status'         => 'nullable',
            'price'          => 'nullable|numeric',
            'payment_type'   => 'required',
        ]);

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
        $bookUsers = User::query()->where('role', 'visitor', 'tenant')->get();
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
    }

    public function update(Request $request, $reserf)
    {
        $reserve = Reserve::findOrFail($reserf);

        $validatedData = $request->validate([
            'user_id'        => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'start'          => 'required',
            'end'            => 'required',
            'rental_item_id' => 'required',
            'status'         => 'required',
            'price'          => 'required|numeric',
            'payment_type'   => 'required',
        ]);

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

        return back();
    }

    public function getReservesJson(Request $request)
    {
        $query = Reserve::query();

        if ($request->has('rental_item_id') && !empty($request->rental_item_id)) {
            $query->where('rental_item_id', $request->rental_item_id);
        }

        $reserves = $query->get();
        $user     = auth()->user();

        $events = $reserves->map(function($reserve) use ($user) {
            if ($user->can('except-visitor')) {
                // Usuário autorizado vê todos os detalhes
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
            } else {
                // Usuário não autorizado vê apenas a hora e título como "Ocupado"
                return [
                    'id'             => $reserve->id,
                    'title'          => 'Ocupado',
                    'start'          => $reserve->start,
                    'end'            => $reserve->end,
                    'rental_item_id' => $reserve->rental_item_id,
                ];
            }
        });

        return response()->json($events);
    }
}
