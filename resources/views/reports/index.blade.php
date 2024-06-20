<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de reservas') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <form method="GET" action="{{ route('reports.index') }}">
            <div class="relative z-0 w-full mb-5 group bg-slate-800 p-8 shadow-md sm:rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <input name="start" id="start" type="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                        <label for="start" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Escolha o período (início)</label>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400"> até</span>
                    <div class="relative z-0 w-full mb-5 group">
                        <input name="end" id="end" type="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                        <label for="end" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Escolha o período (fim)</label>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="rental_item_id" class="sr-only">Underline select</label>
                            <select id="rental_item_id" name="rental_item_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="" selected disabled>Sala</option>
                                @foreach($rental_items as $rental_item)
                                    <option value="{{ $rental_item->id }}">{{ $rental_item->name }}</option>
                                @endforeach
                            </select>
                            @error('rental_item_id')
                            <div class="text-amber-50">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="user_id" class="sr-only">Underline select</label>
                            <select id="user_id" name="user_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="" selected disabled>Usuário</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-amber-50">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Emitir Relatório</button>
            </div>
        </form>

        @if($reservations->isNotEmpty())
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8 bg-white dark:bg-gray-800">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Reserva</th>
                        <th scope="col" class="px-6 py-3">Sala</th>
                        <th scope="col" class="px-6 py-3">Responsável</th>
                        <th scope="col" class="px-6 py-3">Período</th>
                        <th scope="col" class="px-6 py-3">Data de exclusão</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $reservation->description }}</td>
                            <td class="px-6 py-4">{{ $reservation->rentalItem->name }}</td>
                            <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                            <td class="px-6 py-4">{{ $reservation->start }} até {{ $reservation->end }}</td>
                            <td class="px-6 py-4">{{ $reservation->deleted_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Nenhuma reserva encontrada para o período selecionado.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
