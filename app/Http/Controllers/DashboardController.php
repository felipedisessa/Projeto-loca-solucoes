<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bookUsers = User::query()->where('role', 'visitor')->get();
        $bookItems = RentalItem::query()->get();

        return view('dashboard', compact('bookUsers', 'bookItems'));
    }
}
