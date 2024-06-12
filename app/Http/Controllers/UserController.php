<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
