@php
    use App\Enum\RoleEnum;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center mb-4 md:mb-0">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                          d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                {{ __('Usuários') }}
            </h2>
            <div class="w-full max-w-lg md:mx-auto mb-4 md:mb-0">
                <form id="formSearch" method="GET" class="flex w-full">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="search" name="search"
                               value="{{ request('search') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Pesquisar por nome"/>
                    </div>
                    <button type="submit"
                            class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <a href="{{ route('users.index') }}"
                       class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Limpar
                    </a>
                </form>
            </div>
            <div class="flex items-center ml-2 m-2">
                <form id="showDeletedForm" method="GET" action="{{ route('users.index') }}">
                    @csrf
                    <input id="showDeleted" name="showDeleted" type="checkbox" value="1"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                           {{ request('showDeleted') ? 'checked' : '' }}
                           onchange="document.getElementById('showDeletedForm').submit();">
                    <label for="showDeleted"
                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exibir Deletados</label>
                </form>
            </div>
            <button data-modal-target="create-crud-modal" data-modal-toggle="create-crud-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                Cadastrar Usuário
            </button>
        </div>
    </x-slot>
    @if(session('error'))
        <div
            class="error-message fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            <span class="font-medium">Erro:</span> {{ session('error') }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nome</th>
                <th scope="col" class="px-6 py-3">E-mail</th>
                <th scope="col" class="px-6 py-3">Telefone</th>
                <th scope="col" class="px-6 py-3">Permissão</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="relative px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($user->uploads->isNotEmpty())
                            <img class="w-10 h-10 rounded-full absolute left-0 top-1/2 transform -translate-y-1/2"
                                 src="{{ asset($user->uploads->first()->file_path) }}"
                                 alt="{{ $user->name }}">
                        @else
                            <img class="w-10 h-10 rounded-full absolute left-0 top-1/2 transform -translate-y-1/2"
                                 src="{{ asset('images/avatar.jpg') }}"
                                 alt="{{ $user->name }}">
                        @endif
                        <span class="ml-12">{{ $user->name }}</span>
                    </th>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 phone-display">{{ $user->phone }}</td>
                    <td class="px-6 py-4">{{ RoleEnum::from($user->role)->label() }}</td>
                    <td class="px-6 py-4">
    <span class="px-2.5 py-0.5 rounded
        {{ $user->deleted_at ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' }}">
        {{ $user->deleted_at ? 'Deletado' : 'Ativo' }}
    </span>
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-2">
                        @if(!$user->deleted_at)
                            <a href="{{ route('users.show', $user->id) }}" class="cursor-pointer">
                                <x-icons.eye/>
                            </a>
                        @endif
                        @if ($user->deleted_at)
                            <button type="button" class="cursor-pointer text-gray-500"
                                    data-modal-target="reactivate-popup-modal"
                                    data-modal-toggle="reactivate-popup-modal" data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}">
                                <x-icons.arrows-rounded/>
                            </button>
                        @else
                            <button type="button" class="cursor-pointer text-red-500"
                                    data-modal-target="popup-modal"
                                    data-modal-toggle="popup-modal" data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}">
                                <x-icons.trash/>
                            </button>
                        @endif
                        @if(!$user->deleted_at)
                            <a id="edit-button" data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                               data-id="{{ $user->id }}"
                               class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-icons.edit/>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{ $users->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('popup-modal');
            const form = document.getElementById('formExcluirUsuario');

            document.querySelectorAll('button[data-modal-toggle="popup-modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.getAttribute('data-id');
                    form.action = `{{ route('users.destroy', ':id') }}`.replace(':id', userId);
                    modal.classList.remove('hidden');
                });
            });

            modal.querySelector('button[data-modal-hide="popup-modal"]').addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                form.submit();
            });
        });
    </script>
    @include('users.modal.create')
    @include('users.modal.edit')
    @include('users.modal.confirmation-destroy')
    @include('users.modal.confirmation-reactivate')
    @vite('resources/js/users.js')
    @vite('resources/js/user-form-validate.js')
    @vite('resources/js/formatPhone.js')
    @vite('resources/js/cep-validator.js')
</x-app-layout>
