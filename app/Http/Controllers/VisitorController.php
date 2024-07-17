<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    //
    public function showVisitorCalendar()
    {
        $bookItems = RentalItem::query()->get();

        return view('visitorCalendar', compact('bookItems'));
    }

    public function getVisitorReservesJson(Request $request)
    {
        $query = Reserve::query()->where('status', 'confirmado');

        if ($request->has('rental_item_id') && !empty($request->rental_item_id)) {
            $query->where('rental_item_id', $request->rental_item_id);
        }

        $reserves = $query->get();

        $events = $reserves->map(function($reserve) {
            return [
                'id'    => $reserve->id,
                'title' => 'Ocupado',
                'start' => $reserve->start,
                'end'   => $reserve->end,
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
            'mobile'   => 'required',
            'cpf_cnpj' => 'required',
            'company'  => 'required',
            'street'   => 'required',
            'number'   => 'required',
            'city'     => 'required',
            'state'    => 'required',
            'zipcode'  => 'required',
            'country'  => 'required',
        ]);

        $defaultPassword = '12345678';
        // Criação do usuário
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'mobile'   => $request->input('mobile'),
            'role'     => 'visitor',
            'cpf_cnpj' => $request->input('cpf_cnpj'),
            'password' => Hash::make($defaultPassword),
            'company'  => $request->input('company'),
        ]);

        $user->address()->create([
            'street'       => $request->input('street'),
            'number'       => $request->input('number'),
            'complement'   => $request->input('complement'),
            'neighborhood' => $request->input('neighborhood'),
            'city'         => $request->input('city'),
            'state'        => $request->input('state'),
            'zipcode'      => $request->input('zipcode'),
            'country'      => $request->input('country'),
        ]);

        $startDate = Carbon::createFromFormat('d/m/Y H:i', $request->start . ' ' . $request->start_time);
        $endDate   = Carbon::createFromFormat('d/m/Y H:i', $request->end . ' ' . $request->end_time);

        Reserve::create([
            'user_id'        => $user->id,
            'title'          => $request->input('title'),
            'description'    => $request->input('description'),
            'start'          => $startDate,
            'end'            => $endDate,
            'rental_item_id' => $request->input('rental_item_id'),
            'status'         => 'pendente',
            'payment_type'   => $request->input('payment_type'),
        ]);

        return back();
    }
}
