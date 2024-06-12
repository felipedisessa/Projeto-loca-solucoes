<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Items de Locação') }}
            </h2>
            <x-nav-link :href="route('rental-items.create')" :active="request()->routeIs('rental-items.create')"
                        class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                {{ __('Cadastrar item') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nome</th>
                <th scope="col" class="px-6 py-3">Descrição</th>
                <th scope="col" class="px-6 py-3">Proprietário</th>
                <th scope="col" class="px-6 py-3">Preço por dia</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rentalItems as $rentalItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $rentalItem->name }}
                    </th>
                    <td class="px-6 py-4">{{ $rentalItem->description }}</td>
                    <td class="px-6 py-4">{{ $rentalItem->user?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $rentalItem->price_per_day }}</td>
                    <td class="px-6 py-4">{{ $rentalItem->status }}</td>
                    <td class="flex items-center px-6 py-4 space-x-2">
                        <a href="{{route('rental-items.show', $rentalItem->id ) }}" class="cursor-pointer">
                            <x-icons.eye/>
                        </a>

                        <button type="button" class="cursor-pointer text-red-500"
                                data-modal-target="popup-modal"
                                data-modal-toggle="popup-modal"
                                data-id="{{$rentalItem->id}}"
                                data-name="{{$rentalItem->name}}">
                            <x-icons.trash/>
                        </button>

                        <a href="{{route('rental-items.edit', $rentalItem->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <x-icons.edit/>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">{{ $rentalItems->links() }}</div>
    </div>

    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Tem certeza que deseja excluir este item?</h3>
                    <form id="formExcluirItem" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Sim, apagar
                        </button>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Não, cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('popup-modal');
            const form = document.getElementById('formExcluirItem');

            document.querySelectorAll('button[data-modal-toggle="popup-modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    const itemId = button.getAttribute('data-id');
                    const itemName = button.getAttribute('data-name');
                    form.action = `{{route('rental-items.destroy', ':id')}}`.replace(':id', itemId);
                });
            });

            modal.querySelector('button[data-modal-hide="popup-modal"]').addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                modal.classList.add('hidden');
                form.submit();
            });
        });
    </script>
</x-app-layout>
