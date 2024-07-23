<?php

namespace App\Http\Controllers;

use App\Models\User;

class LoginController extends Controller
{
    public function __invoke()
    {
        //se for em producao vai abortar
        if (app()->environment('production')) {
            abort(404);
        }

        $user = User::query()->findOrFail(request()->user);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
