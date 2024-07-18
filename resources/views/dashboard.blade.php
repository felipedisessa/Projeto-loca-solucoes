<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                </svg>
                {{ __('Calendário de Reservas') }}
            </h2>
        </div>
    </x-slot>
    @if(session('error'))
        <div
            class="error-message fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            <span class="font-medium">Erro:</span> {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div
            class="fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-blue-800 bg-blue-50 rounded-lg dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <span class="font-medium">Sucesso:</span> Solicitação feita com sucesso.
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <div>
                        {{ __("Bem vindo, ".auth()->user()->name) . "!" }}<br>
                    </div>
                    <select id="room-filter"
                            class="block w-1/5 pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="">Todas as Salas</option>
                        @foreach($bookItems as $bookItem)
                            <option value="{{ $bookItem->id }}">{{ $bookItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('reserves.modal.create')
@include('reserves.modal.editfullcalendar')
@include('reserves.modal.guestcreate')
@vite('resources/js/reserve-form-validate.js')
@vite('resources/js/datepicker-config.js')
@vite('resources/js/formatMoney.js')

<script>
    window.userRole = "{{ auth()->user()->role }}";
</script>
