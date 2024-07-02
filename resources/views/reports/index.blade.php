<x-app-layout>
    <x-slot name="header" class="print:hidden">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Relatório de reservas') }}
            <svg class="w-6 h-6 text-gray-800 print:hidden dark:text-white" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
            </svg>
        </h2>
    </x-slot>


    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-8">
        <form method="GET" action="{{ route('reports.index') }}" class="print:hidden">
            <div class="relative z-0 w-full mb-5 group bg-slate-800 p-8 shadow-md sm:rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <input value="{{ old('start') }}" name="start" id="start" type="date"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" ">
                        <label for="start"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Escolha o período (início)
                        </label>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400"> até </span>
                    <div class="relative z-0 w-full mb-5 group">
                        <input value="{{ old('end') }}" name="end" id="end" type="date"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" ">
                        <label for="end"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Escolha o período (fim)
                        </label>
                    </div>
                </div>

                <div class="flex items-center space-x-14">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="rental_item_id" class="sr-only">Underline select</label>
                        <select id="rental_item_id" name="rental_item_id"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="" selected disabled>Sala</option>
                            @foreach($rental_items as $rental_item)
                                <option value="{{ $rental_item->id }}">{{ $rental_item->name }}</option>
                            @endforeach
                        </select>
                        @error('rental_item_id')
                        <div class="text-amber-50">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="status" class="sr-only">Underline select</label>
                        <select id="status" name="status"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="" selected disabled>Status</option>
                            <option value="Pago">Pago</option>
                            <option value="Pendente">Pendente</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="confirmado">Confirmado</option>
                        </select>
                        @error('status')
                        <div class="text-amber-50">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="user_id" class="sr-only">Underline select</label>
                        <select id="user_id" name="user_id"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="" selected disabled>Cliente</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="text-amber-50">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="flex items-center mb-4">
                    <input id="showDeleted" name="showDeleted" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="showDeleted" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Exibir
                        reservas deletadas</label>
                </div>

                <div class="flex items-center mb-4">
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Emitir Relatório
                    </button>
                </div>
            </div>
        </form>

        @if($reservations->isNotEmpty())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-white dark:bg-gray-800">
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
                        <th scope="col" class="px-6 py-3">Descricão</th>
                        <th scope="col" class="px-6 py-3">Sala</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Responsável</th>
                        <th scope="col" class="px-6 py-3">Período</th>
                        <th scope="col" class="px-6 py-3">Data de exclusão</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $reservation->title }}</td>
                            <td class="px-6 py-4">{{ $reservation->description }}</td>
                            <td class="px-6 py-4">{{ $reservation->rentalItem->name }}</td>
                            <td class="px-6 py-4">{{ $reservation->status }}</td>
                            <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->start)->format('d/m/Y') }}
                                até {{ \Carbon\Carbon::parse($reservation->end)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">{{ $reservation->deleted_at ?? '-' }}</td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-white dark:bg-gray-800">
                <p class="text-gray-500 dark:text-gray-400">Selecione um periodo válido para gerar o relatório</p>
            </div>
        @endif
    </div>
</x-app-layout>
