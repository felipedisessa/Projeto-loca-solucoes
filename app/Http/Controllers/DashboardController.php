<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bookUsers = User::query()->where('role', 'visitor', 'tenant')->get();
        $bookItems = RentalItem::query()->get();
        $user      = auth()->user();

        return view('dashboard', compact('bookUsers', 'bookItems', 'user'));
    }
}
