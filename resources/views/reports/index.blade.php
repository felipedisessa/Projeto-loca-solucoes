<x-app-layout>
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

    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="GET" action="{{ route('reports.index') }}"
              class="print:hidden bg-white dark:bg-gray-800 p-6 shadow-md rounded-lg space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                        de
                        início</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="start" datepicker type="text" name="start" autocomplete="off"
                               class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Selecione uma data">
                    </div>
                    <div id="start-error" class="text-red-500 text-sm"></div>
                </div>

                <div>
                    <label for="end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de
                        fim</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                    <label for="payment_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                        de Pagamento</label>
                    <select id="payment_status" name="payment_status"
                            class="block w-full py-2.5 px-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Selecione o status de pagamento</option>
                        <option value="paid">Pago</option>
                        <option value="unpaid">Não Pago</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <input id="showDeleted" name="showDeleted" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="showDeleted" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exibir
                        reservas deletadas</label>
                </div>
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Emitir Relatório
                </button>
            </div>
        </form>

        @if($reservations->isNotEmpty())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-white dark:bg-gray-800 mt-6">
                <div class="flex justify-end mb-4">
                    <button type="button"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center"
                            onclick="window.print()">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                        </svg>
                        Imprimir em PDF
                    </button>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Titulo</th>
                        <th scope="col" class="px-6 py-3 print:hidden">Descricão</th>
                        <th scope="col" class="px-6 py-3">Sala</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Responsável</th>
                        <th scope="col" class="px-6 py-3">Pagamento</th>
                        <th scope="col" class="px-6 py-3">Período</th>
                        <th scope="col" class="px-6 py-3 print:hidden">Data de exclusão</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $reservation->title }}</td>
                            <td class="px-6 py-4 print:hidden">{{ $reservation->description }}</td>
                            <td class="px-6 py-4">{{ $reservation->rentalItem->name }}</td>
                            <td class="px-6 py-4">{{ \App\Enum\ReserveEnum::from($reservation->status)->label() }}</td>
                            <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                            <td class="px-6 py-4">
                                {{ $reservation->paid_at ? \Carbon\Carbon::parse($reservation->paid_at)->format('d/m/Y') : 'Não' }}
                            </td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->start)->format('d/m/Y') }}
                                até {{ \Carbon\Carbon::parse($reservation->end)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 print:hidden">{{  $reservation->deleted_at ? $reservation->deleted_at->format('d/m/Y') : '' }}</td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-white dark:bg-gray-800 mt-6">
                <p class="text-gray-500 dark:text-gray-400">Selecione um periodo válido para gerar o relatório</p>
            </div>
        @endif
    </div>
</x-app-layout>
@vite('resources/js/datepicker-config.js')
