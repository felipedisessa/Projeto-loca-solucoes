<?php

namespace App\Http\Controllers;

use App\Models\User;

class LoginController extends Controller
{
    public function __invoke()
    {
        $user = User::query()->findOrFail(request()->user);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
