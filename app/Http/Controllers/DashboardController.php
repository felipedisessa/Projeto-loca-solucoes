<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('except-visitor');

        $bookUsers   = User::query()->whereIn('role', ['visitor', 'tenant'])->get();
        $bookItems   = RentalItem::query()->where('status', 'available')->get();
        $user        = auth()->user();
        $rentalItems = RentalItem::withTrashed()->get();

        $reservesPending = Reserve::query()
            ->where('status', 'pending')
            ->unless(in_array($user->role, ['admin', 'landlord']), function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->with([
                'user' => function($query) {
                    $query->withTrashed();
                },
            ])
            ->get();

        $reservesToday = Reserve::query()
            ->where('status', 'confirmed')
            ->whereDate('start', now()->toDateString())
            ->unless(in_array($user->role, ['admin', 'landlord']), function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy('start', 'asc')
            ->with([
                'user' => function($query) {
                    $query->withTrashed();
                },
            ])
            ->get();

        $reservesNextWeek = Reserve::query()
            ->where('status', 'confirmed')
            ->whereBetween('start', [Carbon::now(), Carbon::now()->addDays(7)])
            ->unless(in_array($user->role, ['admin', 'landlord']), function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy('start', 'asc')
            ->with([
                'user' => function($query) {
                    $query->withTrashed();
                },
            ])
            ->get();

        return view(
            'dashboard',
            compact(
                'bookUsers',
                'bookItems',
                'user',
                'reservesPending',
                'reservesToday',
                'reservesNextWeek',
                'rentalItems'
            )
        );
    }
}
