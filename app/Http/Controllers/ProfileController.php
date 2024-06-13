<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user)
    {
        $updateduser      = $request->all();
        $user->name       = $updateduser['name'];
        $user->email      = $updateduser['email'];
        $user->phone      = $updateduser['phone'];
        $user->mobile     = $updateduser['mobile'];
        $user->role       = $updateduser['role'];
        $user->cpf_cnpj   = $updateduser['cpf_cnpj'];
        $user->user_notes = $updateduser['user_notes'];
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Delete the user's account.
     */
    /*public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }*/

    public function index()
    {
        $users = User::query()->orderBy('created_at', 'desc')->paginate(20);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function store(Request $request)
    {
        User::query()->create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'mobile'     => $request->mobile,
            'role'       => $request->role,
            'cpf_cnpj'   => $request->cpf_cnpj,
            'user_notes' => $request->user_notes,
            'password'   => $request->password,



        ]);

        return back();
    }




}
