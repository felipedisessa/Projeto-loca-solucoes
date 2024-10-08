<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calendário</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/css/calendar.css', 'resources/js/visitor-calendar.js',
 'resources/js/datepicker-config.js', 'resources/js/visitor-form-validate.js', 'resources/js/formatPhone.js', 'resources/js/cep-validator.js'])

    @include('reserves.modal.noAuthCreate')

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #04152a;
            color: #333;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            background-color: #04152a;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #calendar {
            width: 100%;
            height: 80vh;
            max-height: 700px;
            overflow-y: auto;
        }

        /*#toast-default {*/
        /*    position: fixed;*/
        /*    top: 1rem;*/
        /*    right: 1rem;*/
        /*    z-index: 50;*/
        /*}*/

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            #calendar {
                height: 70vh;
                max-height: 400px;
            }

            .p-6 {
                padding: 1rem;
            }

            .text-gray-900 {
                text-align: center;
            }

            #room-filter {
                width: 100%;
                margin-top: 10px;
            }
        }

    </style>
</head>
<body>

@if(session('success'))
    <div
        class="fixed top-4 right-4 z-50 p-4 mb-4 text-sm text-blue-800 bg-blue-50 rounded-lg dark:bg-gray-800 dark:text-blue-400"
        role="alert">
        <span class="font-medium">Sucesso:</span> Solicitação feita com sucesso, aguarde a confirmação em seu e-mail.
    </div>
@endif
<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center flex-wrap">
                    <div class="w-full sm:w-auto mb-4 sm:mb-0">
                        {{ __("Bem-vindo! É um prazer te ver por aqui.")}}<br>
                    </div>
                    <div class="w-full sm:w-auto">
                        <select id="room-filter"
                                class="block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                            <option value="" data-description="">Todas as Salas</option>
                            @foreach($bookItems as $bookItem)
                                <option value="{{ $bookItem->id }}"
                                        data-description="{{ $bookItem->description }}">{{ $bookItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="calendar" class="w-full"></div>
                <div id="room-description"
                     class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-gray-100">
                    Selecione uma sala para ver a descrição.
                </div>
            </div>
        </div>
    </div>
</div>

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

</body>
</html>
