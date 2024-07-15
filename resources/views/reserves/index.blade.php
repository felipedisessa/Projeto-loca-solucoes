<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                </svg>

                {{ __('Reservas') }}
            </h2>
            <div class="max-w-lg mx-auto">
                <form id="formSearch" method="GET" class="max-w-md mx-auto">
                    @csrf
                    @method('GET')
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="search" name="search" value="{{ request('search') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Pesquisar por titulo"/>
                        </div>
                        <button type="submit"
                                class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                        <a href="{{ route('reserves.index') }}"
                           class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Limpar
                        </a>
                        <button type="submit" id="pendingSearch" name="pendingSearch" value="1"
                                class="ms-2 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Pendentes
                            <span
                                class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{ $reserves->where('status', 'pendente')->count() }}
                </span>
                        </button>
                    </div>
                </form>
            </div>
            @can('admin-or-landlord')
                <button data-modal-target="create-crud-modal" data-modal-toggle="create-crud-modal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                    Cadastrar Reserva
                </button>
            @endcan
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Responsável</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Titulo</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Status</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Pagamento</th>
                @can('admin-or-landlord')
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Ações</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($reserves as $reserve)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reserve->user->name  }}
                    </th>
                    <td class="px-6 py-4">{{ $reserve->title}}</td>
                    <td class="px-6 py-4">{{ $reserve->status }}</td>
                    <td class="px-6 py-4">
                        {{ $reserve->paid_at ? \Carbon\Carbon::parse($reserve->paid_at)->format('d/m/Y') : 'Não foi efetuado' }}
                    </td>
                    @can('admin-or-landlord')
                        <td class="flex items-center px-6 py-4 space-x-2">
                            <a href="{{ route('reserves.show', $reserve->id) }}" class="cursor-pointer">
                                <x-icons.eye/>
                            </a>
                            <button type="button" class="cursor-pointer text-red-500"
                                    data-modal-target="popup-modal"
                                    data-modal-toggle="popup-modal"
                                    data-id="{{$reserve->id}}"
                                    data-name="{{$reserve->name}}">
                                <x-icons.trash/>
                            </button>
                            <a id="edit-button" data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                               data-id="{{ $reserve->id }}"
                               class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-icons.edit/>
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="popup-modal" tabindex="-1"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Tem certeza que deseja excluir
                        este item?</h3>
                    <form id="formExcluirItem" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Sim, apagar
                        </button>
                        <button data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Não, cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('reserves.modal.create')
@include('reserves.modal.edit')
@vite('resources/js/reserves.js')
@vite('resources/js/reserve-form-validate.js')
@vite('resources/js/datepicker-config.js')
@vite('resources/js/formatMoney.js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('popup-modal');
        const form = document.getElementById('formExcluirItem');

        document.querySelectorAll('button[data-modal-toggle="popup-modal"]').forEach(button => {
            button.addEventListener('click', () => {
                const itemId = button.getAttribute('data-id');
                const itemName = button.getAttribute('data-name');
                form.action = `{{route('reserves.destroy', ':id')}}`.replace(':id', itemId);
            });
        });

        modal.querySelector('button[data-modal-hide="popup-modal"]').addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            modal.classList.add('hidden');
            form.submit();
        });
    });
</script>
