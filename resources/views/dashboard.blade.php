<x-app-layout>
    <div id="toast-default"
         class="hidden fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
        <div id="toast-message" class="text-sm font-normal"></div>
    </div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center mb-4 md:mb-0">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                </svg>
                {{ __('Calendário de Reservas') }}
            </h2>
            <div class="flex items-center space-x-2">
                <form id="formFilter" method="GET">
                    <label for="room-filter" class="sr-only">Filtrar por Sala</label>
                    <select id="room-filter" name="room-filter"
                            class="p-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <option value="">Todas as Salas</option>
                        @foreach($bookItems as $bookItem)
                            <option value="{{ $bookItem->id }}">{{ $bookItem->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
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

    @can('tenant')
        @if(session('success'))
            <div
                class="fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-blue-800 bg-blue-50 rounded-lg dark:bg-gray-800 dark:text-blue-400 flex items-center"
                role="alert">
                <svg class="w-5 h-5 mr-2 text-blue-800 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8 5a1 1 0 000-2 1 1 0 000 2zm-1-4V7a1 1 0 012 0v4a1 1 0 01-2 0z"
                          clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Sucesso:</span> Solicitação feita com sucesso, aguarde a confirmação em seu
                celular.
            </div>
        @endif
    @endcan

    <div class="w-full max-auto">
        <div class="flex flex-wrap md:flex-nowrap">
            <div class="w-full mx-auto p-4">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                    <div class="w-full md:w-1/3 lg:w-1/4 p-4">
                        <div class="m-4 w-max-md max-auto">
                            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                                <p class="text-2xl font-semibold text-center">{{ __("Olá, ") . auth()->user()->name . "! Bem-vindo de volta! Que bom te ver por aqui." }}</p>
                            </div>

                            @can('admin-or-landlord')
                                <div
                                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex-col items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                 viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                                Reservas de hoje
                                            </h5>
                                        </div>
                                        <a href="{{ route('reserves.index') }}"
                                           class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            Ver todas as reservas
                                        </a>
                                    </div>
                                    @if($reservesToday->isEmpty())
                                        <div
                                            class="flex items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <h1 class="text-lg font-medium text-gray-900 dark:text-white">
                                                Nenhuma reserva para hoje
                                            </h1>
                                        </div>
                                    @endif

                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($reservesToday as $reserve)
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center">
                                                        <div class="flex-1 min-w-0 ms-4">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $reserve->user->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->title }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->rentalItem->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Card para reservas nos próximos 7 dias -->
                                <div
                                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mt-4">
                                    <div class="flex-col items-center justify-between mb-4 ">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                 viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                                            </svg>
                                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                                Reservas nos próximos 7 dias
                                            </h5>
                                        </div>
                                        <a href="{{ route('reserves.index') }}"
                                           class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            Ver todas as reservas
                                        </a>
                                    </div>
                                    @if($reservesNextWeek->isEmpty())
                                        <div
                                            class="flex items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <h1 class="text-lg font-medium text-gray-900 dark:text-white">
                                                Nenhuma reserva para os próximos 7 dias
                                            </h1>
                                        </div>
                                    @endif

                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($reservesNextWeek as $reserve)
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center">
                                                        <div class="flex-1 min-w-0 ms-4">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $reserve->user->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->title }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ \Carbon\Carbon::parse($reserve->start)->format('d/m/Y')}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->rentalItem->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mt-4">
                                    <div class="flex-col items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                 viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                                Reservas pendentes
                                            </h5>
                                        </div>
                                        <a href="{{ route('reserves.index') }}?pendingSearch=1"
                                           class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            Ver reservas pendentes
                                        </a>
                                    </div>
                                    @if($reservesPending->isEmpty())
                                        <div
                                            class="flex items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <h1 class="text-lg font-medium text-gray-900 dark:text-white">
                                                Nenhuma reserva pendente
                                            </h1>
                                        </div>
                                    @endif

                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($reservesPending as $reserve)
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center">
                                                        <div class="flex-1 min-w-0 ms-4">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $reserve->user->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->title }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ \Carbon\Carbon::parse($reserve->start)->format('d/m/Y')}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {{ $reserve->rentalItem->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="w-full md:w-2/3 lg:w-3/4 p-4">
                        <div class="max-w-7xl mx-auto " id="calendar"></div>
                    </div>
                </div>
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
