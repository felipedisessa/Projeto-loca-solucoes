<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        $reservesQuery = Reserve::query()
            ->unless($user->role === 'admin', function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc');

        if (request('pendingSearch')) {
            $reservesQuery->where('status', 'pendente');
        }

        if ($search = request('search')) {
            $reservesQuery->where('title', 'like', '%' . $search . '%');
        }

        $reserves = $reservesQuery->paginate(20);

        if ($reserves->isEmpty()) {
            return redirect()->route('reserves.index');
        }

        $bookUsers = User::query()->whereIn('role', ['tenant'])->get();
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
            'price'          => 'nullable',
            'start_time'     => 'nullable',
            'end_time'       => 'nullable',
            'rental_item_id' => 'required',
            'status'         => 'nullable',
            'paid_at'        => 'nullable',
            'payment_type'   => 'required',
        ]);

        if ($request->paid_at && $request->paid_at !== 'Não foi efetuado') {
            $paidDate = Carbon::createFromFormat('d/m/Y', $request->paid_at);
        } else {
            $paidDate = null;
        }
        $startDate = Carbon::createFromFormat('d/m/Y H:i', $request->start . ' ' . $request->start_time);
        $endDate   = Carbon::createFromFormat('d/m/Y H:i', $request->end . ' ' . $request->end_time);

        $reserveData = [
            'user_id'        => $validatedData['user_id'],
            'title'          => $validatedData['title'],
            'description'    => $validatedData['description'],
            'start'          => $startDate,
            'end'            => $endDate,
            'rental_item_id' => $validatedData['rental_item_id'],
            'status'         => $validatedData['status'],
            'payment_type'   => $validatedData['payment_type'],
            'paid_at'        => $paidDate,
        ];

        if ($request->filled('price')) {
            $price                = str_replace(['R$', ','], '', $request->price) / 100;
            $reserveData['price'] = $price;
        }

        Reserve::query()->create($reserveData);

        return back()->with('success', 'Reserva criada com sucesso!');
    }

    public function create()
    {
        $this->authorize('admin-or-landlord');
        $bookUsers = User::query()->where('role', 'visitor', 'tenant')->get();
        $bookItems = RentalItem::query()->get();

        return view('reserves.modal.create', compact('bookUsers', 'bookItems'));
    }

    public function show($id)
    {
        $this->authorize('admin-or-landlord');
        $reserve = Reserve::findOrFail($id);

        return view('reserves.show', compact('reserve'));
    }

    public function destroy($id)
    {
        $this->authorize('admin-or-landlord');
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();

        return redirect()->route('reserves.index');
    }

    public function edit($id)
    {
        $this->authorize('admin-or-landlord');
        $bookUsers = User::query()->whereIn('role', ['visitor', 'tenant'])->get();
        $bookItems = RentalItem::query()->get();
        $reserve   = Reserve::findOrFail($id);

        return response()->json($reserve);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin-or-landlord');
        $reserve = Reserve::findOrFail($id);

        $validatedData = $request->validate([
            'user_id'        => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'start'          => 'required',
            'end'            => 'required',
            'start_time'     => 'nullable',
            'end_time'       => 'nullable',
            'rental_item_id' => 'required',
            'status'         => 'required',
            'price'          => 'required',
            'payment_type'   => 'required',
            'paid_at'        => 'nullable',
        ]);

        if ($request->paid_at && $request->paid_at !== 'Não foi efetuado') {
            try {
                $paidDate = Carbon::createFromFormat('d/m/Y', $request->paid_at);
            } catch (\Exception $e) {
                $paidDate = null;
            }
        } else {
            $paidDate = null;
        }

        $startDate = Carbon::createFromFormat('d/m/Y H:i', $request->start . ' ' . $request->start_time);
        $endDate   = Carbon::createFromFormat('d/m/Y H:i', $request->end . ' ' . $request->end_time);

        $price = preg_replace('/[^0-9]/', '', $request->price) / 100;

        $reserve->update([
            'user_id'        => $request->user_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'start'          => $startDate,
            'end'            => $endDate,
            'rental_item_id' => $request->rental_item_id,
            'status'         => $request->status,
            'price'          => $price,
            'payment_type'   => $request->payment_type,
            'paid_at'        => $paidDate,
        ]);

        return back();
    }

    public function getReservesJson(Request $request)
    {
        $query = Reserve::query()->where('status', 'confirmado');

        if ($request->has('rental_item_id') && !empty($request->rental_item_id)) {
            $query->where('rental_item_id', $request->rental_item_id);
        }

        $reserves = $query->get();
        $user     = auth()->user();

        $events = $reserves->map(function($reserve) use ($user) {
            if ($user->can('except-visitor')) {
                // Usuário autorizado vê todos os detalhes
                return [
                    'user_id'        => $reserve->user_id,
                    'id'             => $reserve->id,
                    'title'          => $reserve->title,
                    'start'          => $reserve->start,
                    'end'            => $reserve->end,
                    'price'          => $reserve->price,
                    'description'    => $reserve->description,
                    'status'         => $reserve->status,
                    'payment_type'   => $reserve->payment_type,
                    'rental_item_id' => $reserve->rental_item_id,
                    'start_time'     => $reserve->start_time,
                    'end_time'       => $reserve->end_time,
                    'paid_at'        => $reserve->paid_at,
                    'extendedProps'  => [
                        'user_id'        => $reserve->user_id,
                        'rental_item_id' => $reserve->rental_item_id,
                        'description'    => $reserve->description,
                        'status'         => $reserve->status,
                        'start'          => $reserve->start,
                        'end'            => $reserve->end,
                        'price'          => $reserve->price,
                        'payment_type'   => $reserve->payment_type,
                        'paid_at'        => $reserve->paid_at,
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

    public function updateDate(Request $request, $id)
    {
        $this->authorize('admin-or-landlord');
        $reserve = Reserve::findOrFail($id);

        $validatedData = $request->validate([
            'start' => 'required|date',
            'end'   => 'required|date',
        ]);

        $start = Carbon::parse($validatedData['start'])->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');
        $end   = Carbon::parse($validatedData['end'])->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');

        $reserve->start = $start;
        $reserve->end   = $end;
        $reserve->save();

        return response()->json();
    }
}
