<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    public function showVisitorCalendar()
    {
        $bookItems = RentalItem::query()->get();

        return view('visitorCalendar', compact('bookItems'));
    }

    public function getVisitorReservesJson(Request $request)
    {
        $query = Reserve::query()->where('status', 'confirmed');

        if ($request->has('rental_item_id') && ! empty($request->rental_item_id)) {
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

    public function store(ReserveRequest $request)
    {
        $startDate = Carbon::createFromFormat('d/m/Y H:i', $request->start . ' ' . $request->start_time);
        $endDate   = Carbon::createFromFormat('d/m/Y H:i', $request->end . ' ' . $request->end_time);

        $reserve = Reserve::query()
            ->where('rental_item_id', $request->input('rental_item_id'))
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start', [$startDate, $endDate])
                    ->orWhereBetween('end', [$startDate, $endDate])
                    ->orWhere(function($query) use ($startDate, $endDate) {
                        $query->where('start', '<=', $startDate)
                            ->where('end', '>=', $endDate);
                    });
            })
            ->first();

        if ($reserve) {
            return redirect()->back()->with('error', 'A sala está ocupada no período selecionado.');
        }

        $defaultPassword = 'JXjh(C!!Eg0E4KohwOS';

        try {
            $user = User::where('email', $request->input('email'))->first();

            if (! $user) {
                $user = User::create([
                    'name'     => $request->input('name'),
                    'email'    => $request->input('email'),
                    'phone'    => $request->input('phone'),
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
            }

            Reserve::create([
                'user_id'        => $user->id,
                'title'          => $request->input('title'),
                'description'    => $request->input('description'),
                'start'          => $startDate,
                'end'            => $endDate,
                'rental_item_id' => $request->input('rental_item_id'),
                'status'         => 'pending',
                'payment_type'   => $request->input('payment_type'),
            ]);

            return redirect()->back()->with(
                'success',
                'Solicitação feita com sucesso, aguarde a confirmação em seu celular.'
            );
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar sua solicitação.');
        }
    }

    public function checkIfUserExists($email): JsonResponse
    {
        $user = User::query()->where('email', $email)->with('address')->first();

        return response()->json($user);
    }
}
