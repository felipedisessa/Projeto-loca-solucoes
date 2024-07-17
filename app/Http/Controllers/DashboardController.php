<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('except-visitor');

        $bookUsers = User::query()->whereIn('role', ['visitor', 'tenant'])->get();
        $bookItems = RentalItem::query()->get();
        $user      = auth()->user();

        return view('dashboard', compact('bookUsers', 'bookItems', 'user'));
    }
}
