<?php

namespace App\Http\Controllers;

use App\Models\Address;
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
        $user->load('address');

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
        $updateduser = $request->all();
        $user->update($updateduser);

        $user->address()->update([
            'street'       => $request->street,
            'number'       => $request->number,
            'complement'   => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city'         => $request->city,
            'state'        => $request->state,
            'zipcode'      => $request->zipcode,
            'country'      => $request->country,
        ]);

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
        $User = User::query()->create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'mobile'     => $request->mobile,
            'role'       => $request->role,
            'cpf_cnpj'   => $request->cpf_cnpj,
            'user_notes' => $request->user_notes,
            'password'   => $request->password,
        ]);
        Address::query()->create([
            'user_id'      => $User->id,
            'street'       => $request->street,
            'number'       => $request->number,
            'complement'   => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city'         => $request->city,
            'state'        => $request->state,
            'zipcode'      => $request->zipcode,
            'country'      => $request->country,
        ]);

        return back();
    }
}
