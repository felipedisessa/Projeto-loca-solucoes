<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $users     = User::query()->get();
        $EnvConfig = $this->configEnv();

        return view('layouts.guest', compact('users', 'EnvConfig'));
    }

    public function configEnv(): string
    {
        return config('app.env');
    }
}
