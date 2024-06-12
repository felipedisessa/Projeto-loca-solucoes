<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    E-mail
                </th>
                <th scope="col" class="px-6 py-3">
                    Telefone
                </th>
                <th scope="col" class="px-6 py-3">
                    Mobile
                </th>
                <th scope="col" class="px-6 py-3">
                    Permissao
                </th>
                <th scope="col" class="px-6 py-3">
                    Documento
                </th>
                <th scope="col" class="px-6 py-3">
                    Notas
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->mobile }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->role }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->cpf_cnpj}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->user_notes }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{$users->links()}}
        </div>
    </div>

</x-app-layout>
