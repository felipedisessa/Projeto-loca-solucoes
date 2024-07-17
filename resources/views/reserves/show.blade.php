<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reserva :: ') . $reserve->title }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <!-- Responsável -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Responsável</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->name }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->email }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->phone }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->street }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Número</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->number }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->neighborhood }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->city }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Estado</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->state }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->user->address->zipcode }}</dd>
                    </div>
                </div>
            </div>

            <!-- Detalhes da Reserva -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Detalhes da Reserva</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->title }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->description }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Hora de início</dt>
                        <dd class="text-lg font-semibold">{{ \Carbon\Carbon::parse($reserve->start)->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Hora de fim</dt>
                        <dd class="text-lg font-semibold">{{ \Carbon\Carbon::parse($reserve->end)->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Sala</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->rentalItem->name }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Preço</dt>
                        <dd class="text-lg font-semibold">{{ 'R$ ' . number_format($reserve->price, 2, ',', '.') }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Forma de pagamento</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->payment_type }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Pagamento efetuado</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->paid_at ? \Carbon\Carbon::parse($reserve->paid_at)->format('d/m/Y') : 'Não foi efetuado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                        <dd class="text-lg font-semibold">{{ $reserve->status }}</dd>
                    </div>
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
