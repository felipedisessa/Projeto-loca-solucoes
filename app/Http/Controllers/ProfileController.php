<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use AuthorizesRequests;

    /**
     * Retorna os dados do usuário em formato JSON para popular o modal de edição.
     */
    public function edit($id)
    {
        $this->authorize('admin-or-landlord');
        $user = User::with(['address', 'uploads'])->findOrFail($id);

        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        $user->save();

        return redirect()->route('profile.edit');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            // Deletar a imagem antiga, se existir
            if ($user->uploads()->exists()) {
                $oldImage = $user->uploads()->first();
                Storage::delete($oldImage->file_path);
                $oldImage->delete();
            }

            // Adicionar a nova imagem
            $image     = $request->file('profile_image');
            $path      = $image->store('uploads');
            $imageName = $image->getClientOriginalName();

            $user->uploads()->create([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Imagem de perfil atualizada com sucesso.');
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Exibe o formulário de criação de usuário.
     */
    public function create()
    {
        $this->authorize('admin-or-landlord');

        return view('users.modal.create');
    }

    /**
     * Atualiza as informações do usuário.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('admin-or-landlord');

        $updatedUser = $request->except('password');

        if ($request->filled('password')) {
            $updatedUser['password'] = bcrypt($request->password);
        }

        $user->update($updatedUser);

        $addressData = $request->all();

        $user->address()->updateOrCreate(['user_id' => $user->id], $addressData);

        if ($request->hasFile('profile_image')) {
            if ($user->uploads()->exists()) {
                $oldImage = $user->uploads()->first();
                Storage::delete($oldImage->file_path);
                $oldImage->delete();
            }

            $image     = $request->file('profile_image');
            $path      = $image->store('uploads');
            $imageName = $image->getClientOriginalName();

            $user->uploads()->create([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Exibe a lista de usuários.
     */
    public function index(Request $request)
    {
        $this->authorize('admin-or-landlord');

        if ($request->has('reactivate')) {
            User::withTrashed()->where('id', $request->input('reactivate'))->update(['deleted_at' => null]);
        }

        $search      = $request->input('search');
        $showDeleted = $request->input('showDeleted');

        $usersQuery = User::query()->orderBy('created_at', 'desc')->with('address');

        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%');
        }

        if ($showDeleted) {
            $usersQuery->withTrashed();
        }

        $users = $usersQuery->paginate(20);

        return view('users.index', compact('users', 'search', 'showDeleted'));
    }

    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function show(User $user)
    {
        $this->authorize('admin-or-landlord');

        $user->loadCount([
            'reserves', 'reserves as reserves_cancelled_count' => function($query) {
                $query->where('status', 'canceled');
            }, 'reserves as reserves_active_count' => function($query) {
                $query->where('status', 'confirmed');
            },
        ]);
        $user->load('uploads');
        $user->last_reserve = $user->reserves()->latest('end')->first()->end ?? 'Não disponível';
        $user->total_spent  = $user->reserves()->sum('price')                ?? 0;

        return view('users.show', compact('user'));
    }

    /**
     * Exclui um usuário.
     */
    public function destroy(User $user)
    {
        $this->authorize('admin-or-landlord');
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * Armazena um novo usuário e seu endereço.
     */
    public function store(Request $request)
    {
        $this->authorize('admin-or-landlord');

        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:255',
            'role'          => 'required|string|max:255',
            'cpf_cnpj'      => 'required',
            'password'      => 'required|string',
            'company'       => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $ActiveDefault = true;

        try {
            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
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
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                if (str_contains($e->getMessage(), 'users_email_unique')) {
                    return redirect()->back()->with('error', 'O e-mail informado já está em uso.');
                } elseif (str_contains($e->getMessage(), 'users_cpf_cnpj_unique')) {
                    return redirect()->back()->with('error', 'O CPF/CNPJ informado já está em uso.');
                } elseif (str_contains($e->getMessage(), 'users_phone_unique')) {
                    return redirect()->back()->with('error', 'O telefone informado já está em uso.');
                } elseif (str_contains($e->getMessage(), 'users_mobile_unique')) {
                    return redirect()->back()->with('error', 'O celular informado já está em uso.');
                }
            }

            throw $e;
        }

        if ($request->hasFile('profile_image')) {
            $image     = $request->file('profile_image');
            $path      = $image->store('uploads');
            $imageName = $image->getClientOriginalName();

            $user->uploads()->create([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
        }

        return back()->with('success', 'Usuário criado com sucesso.');
    }

    public function deleteProfileImage()
    {
        $user = Auth::user();

        if ($user->uploads()->exists()) {
            $oldImage = $user->uploads()->first();
            Storage::delete($oldImage->file_path);
            $oldImage->delete();
        }

        return redirect()->route('profile.edit')->with('success', 'Imagem de perfil excluída com sucesso.');
    }
}
