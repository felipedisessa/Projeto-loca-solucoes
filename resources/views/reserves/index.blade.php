<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Reservas') }}
            </h2>
            <a href="{{route('reserves.create')}}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Cadastrar Reserva
            </a>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Titulo</th>
                <th scope="col" class="px-6 py-3">Descrição</th>
                <th scope="col" class="px-6 py-3">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reserves as $reserve)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reserve->title}}
                    </th>
                    <td class="px-6 py-4">{{ $reserve->description }}</td>
                    <td class="px-6 py-4">{{ $reserve->status }}</td>
                    <td class="flex items-center px-6 py-4 space-x-2">
                        <a href="{{ route('reserves.show', $reserve->id) }}" class="cursor-pointer">
                            <x-icons.eye />
                        </a>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
