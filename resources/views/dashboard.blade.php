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
                            <option value="{{ $bookItem->id }}" data-description="{{ $bookItem->description }}"
                                    data-carousel-id="carousel-{{ $bookItem->id }}">
                                {{ $bookItem->name }}
                            </option>
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
                            <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-start items-center flex-col">
                                @if(auth()->user()->uploads->isNotEmpty())
                                    <img src="{{ asset(auth()->user()->uploads->first()->file_path) }}"
                                         class="w-16 h-16 rounded-full mb-4 object-cover"
                                         alt="{{ auth()->user()->name }}">
                                @else
                                    <img src="{!! asset('images/avatar.jpg') !!}"
                                         class="w-16 h-16 rounded-full mb-4 object-cover"
                                         alt="default avatar">
                                @endif
                                <p class="text-2xl font-semibold text-center">{{ __("Olá, ") . auth()->user()->name . "! Bem-vindo de volta! Que bom te ver por aqui." }}</p>
                            </div>

                            <div id="gallery" class="relative w-full"
                                 data-carousel="static">
                                <div class="relative h-48 overflow-hidden rounded-lg md:h-64">
                                    @foreach($rentalItems as $rentalItem)
                                        @if($rentalItem->uploads->isNotEmpty())
                                            @foreach($rentalItem->uploads as $upload)
                                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                    <img src="{{ asset($upload->file_path) }}"
                                                         class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                         alt="{{ $upload->file_name }}">
                                                    <div
                                                        class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-center py-2">
                                                        {{ $rentalItem->name }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Slider controls -->
                                <button type="button"
                                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
                                </button>
                                <button type="button"
                                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span></button>
                            </div>
                            {{--                            fim galeria--}}

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
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        @if($reserve->user->uploads->isNotEmpty())
                                                            <img
                                                                src="{{ asset($reserve->user->uploads->first()->file_path) }}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="avatar">
                                                        @else
                                                            <img
                                                                src="{!! asset('images/avatar.jpg')!!}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="default avatar">
                                                        @endif
                                                    </div>
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
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        @if($reserve->user->uploads->isNotEmpty())
                                                            <img
                                                                src="{{ asset($reserve->user->uploads->first()->file_path) }}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="avatar">
                                                        @else
                                                            <img
                                                                src="{!! asset('images/avatar.jpg')!!}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="default avatar">
                                                        @endif
                                                    </div>
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
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        @if($reserve->user->uploads->isNotEmpty())
                                                            <img
                                                                src="{{ asset($reserve->user->uploads->first()->file_path) }}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="avatar">
                                                        @else
                                                            <img
                                                                src="{!! asset('images/avatar.jpg')!!}"
                                                                class="w-8 h-8 rounded-full"
                                                                alt="default avatar">
                                                        @endif
                                                    </div>
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
                        </div>
                    </div>

                    <div class="w-full md:w-2/3 lg:w-3/4 p-4">
                        <div id="room-description"
                             class="max-w-7xl mx-auto mt-4 m-2 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-gray-100">
                            Selecione uma sala para ver a descrição.
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roomFilter = document.getElementById('room-filter');
        const roomDescription = document.getElementById('room-description');

        roomFilter.addEventListener('change', function () {
            const selectedOption = roomFilter.options[roomFilter.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            roomDescription.textContent = description || 'Selecione uma sala para ver a descrição.';
        });
    });
</script>
