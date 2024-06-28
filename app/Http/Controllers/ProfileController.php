<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Retorna os dados do usuário em formato JSON para popular o modal de edição.
     */
    public function edit($id)
    {
        $user = User::with('address')->findOrFail($id);

        return response()->json($user);
    }

    /**
     * Exibe o formulário de criação de usuário.
     */
    public function create()
    {
        return view('users.modal.create');
    }

    /**
     * Atualiza as informações do usuário.
     */
    public function update(Request $request, User $user)
    {
        $updatedUser = $request->except('password');

        if ($request->filled('password')) {
            $updatedUser['password'] = bcrypt($request->password);
        }

        $user->update($updatedUser);

        $addressData = $request->all();

        $user->address()->updateOrCreate(['user_id' => $user->id], $addressData);

        return redirect()->route('users.index');
    }

    /**
     * Exibe a lista de usuários.
     */
    public function index()
    {
        $search = request('search');
        $users  = User::query()->orderBy('created_at', 'desc')->with('address')->when(
            $search,
            function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        )->paginate(20);

        if ($users->isEmpty()) {
            // Redireciona de volta ao index se nao existir nenhum usuario
            return redirect()->route('users.index');
        }

        return view('users.index', compact('users'));
    }

    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Exclui um usuário.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * Armazena um novo usuário e seu endereço.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required',
            'email'      => 'required',
            'phone'      => 'required|numeric',
            'mobile'     => 'required|numeric',
            'role'       => 'required',
            'cpf_cnpj'   => 'required|numeric',
            'user_notes' => 'required',
            'password'   => 'required',
            'company'    => 'required',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'mobile'     => $request->mobile,
            'role'       => $request->role,
            'cpf_cnpj'   => $request->cpf_cnpj,
            'user_notes' => $request->user_notes,
            'password'   => bcrypt($request->password),
            'company'    => $request->company,
        ]);

        $addressData = $request->only([
            'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'zipcode', 'country',
        ]);
        $user->address()->create($addressData);

        return back();
    }
}
