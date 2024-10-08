@php use App\Enum\RentalItemEnum; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                </svg>
                {{ __('Item de Locação :: ') . $rentalItem->name }}
            </h2>
            <a href="{{ route('rental-items.index') }}"
               class="p-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="w-full max-auto">
        <div class="flex flex-wrap md:flex-nowrap">
            <div class="w-full mx-auto p-4">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                    <!-- Info Section -->
                    <dl class="p-4 sm:p-6 lg:p-8 grid grid-cols-1 lg:grid-cols-3 gap-6 text-gray-900 dark:text-white ">
                        <!-- Dados do Item -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Dados do Item</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                @if($rentalItem->uploads->isNotEmpty())
                                    <div id="gallery" class="mb-4">
                                        <div class="relative h-56 overflow-hidden rounded-lg md:h-72">
                                            <img src="{{ asset($rentalItem->uploads->first()->file_path) }}"
                                                 class="block h-full object-contain rounded-lg"
                                                 alt="{{ $rentalItem->name }}">
                                        </div>
                                    </div>
                                @endif
                                @foreach([
                                    'Nome' => $rentalItem->name,
                                    'Proprietário' => $rentalItem->user->name,
                                    'Descrição' => $rentalItem->description,
                                    'Preço por hora' => 'R$ ' . number_format($rentalItem->price_per_hour, 2, ',', '.'),
                                    'Preço por dia' => 'R$ ' . number_format($rentalItem->price_per_day, 2, ',', '.'),
                                    'Preço por mês' => 'R$ ' . number_format($rentalItem->price_per_month, 2, ',', '.'),
                                    'Status' => RentalItemEnum::from($rentalItem->status)->label(), // Status em português
                                    'Observações' => $rentalItem->rental_item_notes ?? 'Não informado',
                                ] as $label => $value)
                                    <div class="mb-4">
                                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                                        <dd class="text-lg font-semibold">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Endereço -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Endereço</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                @foreach([
                                    'Rua' => $rentalItem->address->street ?? 'Não informado',
                                    'Número' => $rentalItem->address->number ?? 'Não informado',
                                    'Complemento' => $rentalItem->address->complement ?? 'Não informado',
                                    'Bairro' => $rentalItem->address->neighborhood ?? 'Não informado',
                                    'Cidade' => $rentalItem->address->city ?? 'Não informado',
                                    'Estado' => $rentalItem->address->state ?? 'Não informado',
                                    'CEP' => $rentalItem->address->zipcode ?? 'Não informado',
                                    'País' => $rentalItem->address->country ?? 'Não informado'
                                ] as $label => $value)
                                    <div class="mb-4">
                                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                                        <dd class="text-lg font-semibold">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Estatísticas -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Estatísticas</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                <div class="mb-4">
                                    <div class="flex items-center space-x-4">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                                        </svg>
                                        <div>
                                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">
                                                Média de
                                                Reservas por Mês
                                            </dt>
                                            <dd class="text-lg font-semibold">{{ number_format($averageReservesPerMonth, 2, ',', '.') }}</dd>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="flex items-center space-x-4">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                                        </svg>
                                        <div>
                                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">
                                                Total de
                                                Receita Gerada
                                            </dt>
                                            <dd class="text-lg font-semibold">
                                                R$ {{ number_format($totalRevenue, 2, ',', '.') }}</dd>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-4">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                                        </svg>
                                        <div>
                                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">
                                                Total de
                                                Reservas
                                            </dt>
                                            <dd class="text-lg font-semibold">{{ $totalReserves }}</dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
