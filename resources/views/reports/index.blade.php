@php use App\Enum\ReserveEnum;use Carbon\Carbon; @endphp
<x-app-layout>
    <div id="toast-default"
         class="hidden fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
        <div id="toast-message" class="text-sm font-normal"></div>
    </div>
    <x-slot name="header" class="print:hidden">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center py-2">
            <svg class="w-6 h-6 text-gray-800 mr-2 dark:text-white" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
            </svg>
            {{ __('Relatório de reservas') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div class="w-full mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto p-4 sm:p-6 lg:p-8 grid grid-cols-12 gap-4">
                    <div
                        class="print:hidden col-span-12 lg:col-span-6 bg-white dark:bg-gray-700 p-6 shadow-md rounded-lg space-y-6">
                        <!-- Botões Predefinidos -->
                        <div class="flex flex-col sm:justify-between sm:flex-row sm:items-center gap-4 mb-4">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white sm:mb-2">Filtros
                                Predefinidos
                            </div>
                            <div class="flex items-center space-x-4">
                                <form class="w-full" method="GET" action="{{ route('reports.index') }}">
                                    <input type="hidden" name="filter" value="today">
                                    <button type="submit"
                                            class="w-full justify-center sm:max-w-max text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center">
                                        <svg class="w-4 h-4 text-white mr-2" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Reservas de Hoje
                                    </button>
                                </form>
                                <form class="w-full" method="GET" action="{{ route('reports.index') }}">
                                    <input type="hidden" name="filter" value="week">
                                    <button type="submit"
                                            class="w-full justify-center sm:max-w-max sm:min-w-max text-white bg-blue-700 hover:bg-blue-800
                                             focus:ring-4 focus:ring-blue-300 font-medium rounded-lg
                                             text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
                                             focus:outline-none dark:focus:ring-blue-800 flex items-center">
                                        <svg class="w-4 h-4 text-white mr-2" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Reservas da Semana
                                    </button>
                                </form>
                                <form class="w-full" method="GET" action="{{ route('reports.index') }}">
                                    <input type="hidden" name="filter" value="month">
                                    <button type="submit"
                                            class="w-full sm:max-w-max flex items-center text-white justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4
                                         focus:ring-blue-300 font-medium rounded-lg
                                         text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                                         dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 text-white mr-2" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Reservas do Mês
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Formulário de Filtro Personalizado -->
                        <form method="GET" action="{{ route('reports.index') }}" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="start"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                                        de início</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="start" datepicker type="text" name="start" autocomplete="off"
                                               class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900
                                               text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                                               pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                               dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="Selecione uma data">
                                    </div>
                                    <div id="start-error" class="text-red-500 text-sm"></div>
                                </div>

                                <div>
                                    <label for="end"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                                        de fim</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="end" datepicker type="text" name="end" autocomplete="off"
                                               class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="Selecione uma data">
                                    </div>
                                    <div id="end-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="rental_item_id"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                                    <select id="rental_item_id" name="rental_item_id"
                                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecione uma sala</option>
                                        @foreach($rental_items as $rental_item)
                                            <option value="{{ $rental_item->id }}">{{ $rental_item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="status"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                    <select id="status" name="status"
                                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecione o status</option>
                                        <option value="pending">Pendente</option>
                                        <option value="confirmed">Confirmada</option>
                                        <option value="canceled">Cancelada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="user_id"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                                    <select id="user_id" name="user_id"
                                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecione um cliente</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="payment_status"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        de Pagamento</label>
                                    <select id="payment_status" name="payment_status"
                                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecione o status de pagamento</option>
                                        <option value="paid">Pago</option>
                                        <option value="unpaid">Não Pago</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="payment_type"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma de
                                        pagamento</label>
                                    <select id="payment_type" name="payment_type"
                                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecione a forma de pagamento</option>
                                        <option value="Pix">Pix</option>
                                        <option value="Cartao">Cartão</option>
                                        <option value="Boleto">Boleto</option>
                                        <option value="Não se aplica">Não se aplica</option>
                                    </select>
                                </div>

                                <div class="flex items-center">
                                    <input id="showDeleted" name="showDeleted" type="checkbox" value=""
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="showDeleted"
                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exibir
                                        reservas deletadas</label>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                        class="justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                         viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                              d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                                    </svg>
                                    Emitir Relatório
                                </button>
                            </div>
                        </form>
                    </div>


                    <div
                        class="col-span-12 lg:col-span-6 relative overflow-x-auto shadow-md sm:rounded-lg p-6 bg-gray-100 dark:bg-gray-700">
                        @if($reservations->isNotEmpty())
                            <div class="flex justify-end mb-4">
                                <button type="button"
                                        class="justify-center print:hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center"
                                        onclick="window.print()">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                         viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                                    </svg>
                                    Imprimir em PDF
                                </button>
                            </div>
                            <table
                                class="w-full text-sm  text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Titulo</th>
                                    <th scope="col" class="px-6 py-3 print:hidden">Descricão</th>
                                    <th scope="col" class="px-6 py-3">Sala</th>
                                    <th scope="col" class="px-6 py-3 ">Status</th>
                                    <th scope="col" class="px-6 py-3">Responsável</th>
                                    <th scope="col" class="px-6 py-3 print:hidden">Pagamento</th>
                                    <th scope="col" class="px-6 py-3">Forma de pagamento</th>
                                    <th scope="col" class="px-6 py-3">Data</th>
                                    <th scope="col" class="px-6 py-3 print:hidden">Data de exclusão</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reservations as $reservation)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $reservation->title }}</td>
                                        <td class="px-6 py-4 print:hidden">{{ $reservation->description }}</td>
                                        <td class="px-6 py-4">{{ $reservation->rentalItem->name }}</td>
                                        <td class="px-6 py-4">{{ ReserveEnum::from($reservation->status)->label() }}</td>
                                        <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                                        <td class="px-6 py-4 print:hidden">
                                            {{ $reservation->paid_at ? Carbon::parse($reservation->paid_at)->format('d/m/Y') : 'Não pago' }}
                                        </td>
                                        <td class="px-6 py-4">{{ $reservation->payment_type }}</td>
                                        <td class="px-6 py-4">{{ Carbon::parse($reservation->start)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 print:hidden">{{  $reservation->deleted_at ? $reservation->deleted_at->format('d/m/Y') : '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center">Nenhuma reserva encontrada para o
                                            período selecionado.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        @else
                            <div
                                class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-gray-100 dark:bg-gray-800 mt-6">
                                <p class="text-gray-500 dark:text-gray-400">Selecione um período válido para gerar o
                                    relatório</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/datepicker-config.js')
