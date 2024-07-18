<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item de Locação :: ') . $rentalItem->name }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <!-- Dados do Item -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Dados do Item</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    @foreach([
                        'Nome' => $rentalItem->name,
                        'Proprietário' => $rentalItem->user->name,
                        'Descrição' => $rentalItem->description,
                        'Preço por hora' => 'R$ ' . number_format($rentalItem->price_per_hour, 2, ',', '.'),
                        'Preço por dia' => 'R$ ' . number_format($rentalItem->price_per_day, 2, ',', '.'),
                        'Preço por mês' => 'R$ ' . number_format($rentalItem->price_per_month, 2, ',', '.'),
                        'Status' => $rentalItem->status,
                        'Observações' => $rentalItem->rental_item_notes ?? 'Não informado'
                    ] as $label => $value)
                        <div class="mb-2">
                            <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-lg font-semibold">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Endereço -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Endereço</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
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
                        <div class="mb-2">
                            <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-lg font-semibold">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Média de Reservas por Mês -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-2">Estatísticas</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
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
                            <dd class="text-lg font-semibold">{{ number_format($averageReservesPerMonth, 2, ',', '.') }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
