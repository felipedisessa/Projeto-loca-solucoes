@php
    use App\Enum\RentalItemEnum;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center mb-4 md:mb-0">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                </svg>
                {{ __('Items de locação') }}
            </h2>
            <div class="w-full max-w-lg md:mx-auto mb-4 md:mb-0">
                <form id="formSearch" method="GET" class="flex w-full">
                    @method('GET')
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="search" name="search" value="{{ request('search') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Pesquisar por sala"/>
                    </div>
                    <button type="submit"
                            class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <a href="{{ route('rental-items.index') }}"
                       class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Limpar
                    </a>
                </form>
            </div>
            <button data-modal-target="create-crud-modal" data-modal-toggle="create-crud-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                Cadastrar Item
            </button>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        @if ($rentalItems->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400">
                <p>Não há items de locação.</p>
            </div>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nome</th>
                    <th scope="col" class="px-6 py-3">Proprietário</th>
                    <th scope="col" class="px-6 py-3">Preço por hora</th>
                    <th scope="col" class="px-6 py-3">Preço por dia</th>
                    <th scope="col" class="px-6 py-3">Preço por mês</th>
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
                        <td class="px-6 py-4">{{ $rentalItem->user?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $rentalItem->formatted_price_per_hour }}</td>
                        <td class="px-6 py-4">{{ $rentalItem->formatted_price_per_day }}</td>
                        <td class="px-6 py-4">{{ $rentalItem->formatted_price_per_month }}</td>
                        <td class="px-6 py-4">
    <span class="px-2.5 py-0.5 rounded
        {{
            match (RentalItemEnum::from($rentalItem->status)) {
                RentalItemEnum::available => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                RentalItemEnum::reserved => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
                RentalItemEnum::maintenance => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
            }
        }}">
        {{ RentalItemEnum::from($rentalItem->status)->label() }}
    </span>
                        </td>

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

                            <a id="edit-button" data-modal-target="edit-crud-modal" data-modal-toggle="edit-crud-modal"
                               data-id="{{ $rentalItem->id }}"
                               class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <x-icons.edit/>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="my-4">{{ $rentalItems->links() }}</div>
        @endif
    </div>

    @include('rental-items.modal.create')
    @include('rental-items.modal.confirmation-desroy')
    @includeWhen(isset($rentalItem), 'rental-items.modal.edit')
    @vite('resources/js/rental-items.js')
    @vite('resources/js/rental-item-form-validate.js')
    @vite('resources/js/cep-validator.js')
    @vite('resources/js/formatMoney.js')

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
