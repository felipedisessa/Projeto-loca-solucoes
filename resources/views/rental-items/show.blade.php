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
               class="flex items-center p-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 m-4 mx-auto">
        <!-- Galeria -->
        <div id="gallery" class="relative w-full md:col-span-1" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-lg md:h-full">
                @foreach($rentalItem->uploads as $upload)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset($upload->file_path) }}"
                             class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                             alt="{{ $rentalItem->name }}">
                    </div>
                @endforeach
            </div>
            <button type="button"
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

        <!-- Dados do Item e Endereço -->
        <div class="md:col-span-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Dados do Item</h3>
                    @foreach([
                        'Nome' => $rentalItem->name,
                        'Proprietário' => $rentalItem->user->name,
                        'Descrição' => $rentalItem->description,
                        'Preço por hora' => 'R$ ' . number_format($rentalItem->price_per_hour, 2, ',', '.'),
                        'Preço por dia' => 'R$ ' . number_format($rentalItem->price_per_day, 2, ',', '.'),
                        'Preço por mês' => 'R$ ' . number_format($rentalItem->price_per_month, 2, ',', '.'),
                        'Status' => \App\Enum\RentalItemEnum::from($rentalItem->status)->label(), // Status em português
                        'Observações' => $rentalItem->rental_item_notes ?? 'Não informado',
                    ] as $label => $value)
                        <div class="mb-4">
                            <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-white">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Endereço</h3>
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
                            <dd class="text-lg font-semibold text-gray-900 dark:text-white">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="md:col-span-3">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Estatísticas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Média de
                                Reservas por Mês
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format($averageReservesPerMonth, 2, ',', '.') }}</dd>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Total de
                                Receita Gerada
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-white">
                                R$ {{ number_format($totalRevenue, 2, ',', '.') }}</dd>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Total de
                                Reservas
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalReserves }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
