@php
    use App\Enum\ReserveEnum;use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center mb-4 md:mb-0">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                </svg>
                {{ __('Reservas') }}
            </h2>
            <div class="w-full max-w-lg md:mx-auto mb-4 md:mb-0">
                <form id="formSearch" method="GET" class="flex w-full">
                    @method('GET')
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="search" name="search" value="{{ request('search') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Pesquisar por titulo"/>
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
                    <a href="{{ route('reserves.index') }}"
                       class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Limpar
                    </a>
                    <button type="submit" id="pendingSearch" name="pendingSearch" value="1"
                            class="ml-2 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Pendentes
                        <span
                            class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                            {{ $reserves->where('status', 'pending')->count() }}
                        </span>
                    </button>
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
    @if(session('error'))
        <div
            class="fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 flex items-center"
            role="alert">
            <svg class="w-5 h-5 mr-2 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M18 8a1 1 0 01.117 1.993L18 10h-2v3a1 1 0 01-1 1h-3v2a1 1 0 01-.883.993L11 17H9a1 1 0 01-.993-.883L8 16v-2H5a1 1 0 01-.993-.883L4 13V10H2a1 1 0 01-.117-1.993L2 8h16zm-3 1h-2V6a1 1 0 011-1h1a1 1 0 01.993.883L17 6v3zm-9 1V7a1 1 0 00-1-1H6a1 1 0 00-.993.883L5 7v3H3V9a1 1 0 00-.883-.993L2 8h1v2h3v3H4a1 1 0 00-.993.883L3 14v2a1 1 0 00.883.993L4 17h2a1 1 0 00.993-.883L7 16v-2h2a1 1 0 00.993-.883L10 13v-2H9V9z"
                      clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Erro:</span> {{ session('error') }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        @if ($reserves->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400">
                <p>Não há reservas disponíveis no momento.</p>
            </div>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Responsável</th>
                    <th scope="col" class="px-6 py-3">Titulo</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Preço</th>
                    <th scope="col" class="px-6 py-3">Pagamento</th>
                    <th scope="col" class="px-6 py-3">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reserves as $reserve)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $reserve->user->name ?? 'Usuário desativado' }}
                        </th>
                        <td class="px-6 py-4">{{ $reserve->title }}</td>
                        <td class="px-6 py-4">
 <span class="px-2.5 py-0.5 rounded
     {{
         match (ReserveEnum::from($reserve->status)) {
             ReserveEnum::pending => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
             ReserveEnum::confirmed => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
             ReserveEnum::canceled => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
         }
     }}">
     {{ ReserveEnum::from($reserve->status)->label() }}
 </span>
                        </td>

                        <td class="px-6 py-4">{{ $reserve->formatted_price }}</td>
                        <td class="px-6 py-4">
                            {{ $reserve->paid_at ? Carbon::parse($reserve->paid_at)->format('d/m/Y') : 'Não foi efetuado' }}
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-2">
                            @can('tenant')
                                <a href="{{ route('download-ics', $reserve->id) }}"
                                   class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Salvar no calendário
                                </a>
                            @endcan
                            @can('admin-or-landlord')
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
                                <a id="edit-button" data-modal-target="edit-crud-modal"
                                   data-modal-toggle="edit-crud-modal"
                                   data-id="{{ $reserve->id }}"
                                   class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <x-icons.edit/>
                                </a>
                                @if($reserve->status === 'pending')
                                    <a id="confirm-button" data-modal-target="confirm-popup-modal"
                                       data-modal-toggle="confirm-popup-modal"
                                       data-id="{{ $reserve->id }}"
                                       class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <x-icons.check/>
                                    </a>
                                @endif
                        </td>
                    @endcan
                @endforeach
                </tbody>
            </table>
            <div class="my-4">
                {{ $reserves->links() }}
            </div>
        @endif
    </div>

</x-app-layout>

@include('reserves.modal.create')
@include('reserves.modal.confirmation-reserve')
@include('reserves.modal.confirmation-destroy')
@includeWhen(isset($reserve), 'reserves.modal.edit')
@vite('resources/js/reserves.js')
@vite('resources/js/reserve-form-validate.js')
@vite('resources/js/datepicker-config.js')
@vite('resources/js/formatMoney.js')

@can('admin-or-landlord')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('popup-modal');
            const form = document.getElementById('formExcluirItem');

            document.querySelectorAll('button[data-modal-toggle="popup-modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    const itemId = button.getAttribute('data-id');
                    form.action = `{{route('reserves.destroy', ':id')}}`.replace(':id', itemId);
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
@endcan
