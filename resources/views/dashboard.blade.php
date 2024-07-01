<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ __('Calendário de Reservas') }}
            <svg class="w-6 h-6 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
            </svg>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bem vindo, ".auth()->user()->name) }}
                </div>
                <div class="flex justify-between items-center mb-4">
                    <select id="room-filter"
                            class=" ml-5 mt-1 block w-1/5 pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
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
@vite('resources/js/reserve-form-validate.js')

<script>
    window.userRole = "{{ auth()->user()->role }}";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/locale/pt-br.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script>

<link href="{{ mix('css/app.css') }}" rel="stylesheet">
