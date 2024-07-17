<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item de locação :: ') . $rentalItem->name }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <!-- Dados do Item -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Dados do Item</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->name }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Proprietário</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->user->name }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->description }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Preço por hora</dt>
                        <dd class="text-lg font-semibold">{{ 'R$ ' . number_format($rentalItem->price_per_hour, 2, ',', '.') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Preço por dia</dt>
                        <dd class="text-lg font-semibold">{{ 'R$ ' . number_format($rentalItem->price_per_day, 2, ',', '.') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Preço por mês</dt>
                        <dd class="text-lg font-semibold">{{ 'R$ ' . number_format($rentalItem->price_per_month, 2, ',', '.') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->status }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->rental_item_notes ?? 'Não informado' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Endereço -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Endereço</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->street ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Número</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->number ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Complemento</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->complement ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->neighborhood ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->city ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Estado</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->state ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->zipcode ?? 'Não informado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">País</dt>
                        <dd class="text-lg font-semibold">{{ $rentalItem->address->country ?? 'Não informado' }}</dd>
                    </div>
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
