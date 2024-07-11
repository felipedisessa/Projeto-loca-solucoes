<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reserva :: ') . $reserve->title }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-lg mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Responsável</dt>
                <dd class="text-lg font-semibold">{{ $reserve->user->name }}</dd>
            </div>
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                <dd class="text-lg font-semibold">{{ $reserve->title }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
                <dd class="text-lg font-semibold">{{ $reserve->description }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Hora de início</dt>
                <dd class="text-lg font-semibold">{{ \Carbon\Carbon::parse($reserve->start)->format('d/m/Y') }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Hora de fim</dt>
                <dd class="text-lg font-semibold">{{ \Carbon\Carbon::parse($reserve->end)->format('d/m/Y') }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Sala</dt>
                <dd class="text-lg font-semibold">{{ $reserve->rentalItem->name }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Preço</dt>
                <dd class="mask-money text-lg font-semibold">{{ 'R$' .$reserve->price }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Forma de pagamento</dt>
                <dd class="text-lg font-semibold">{{ $reserve->payment_type }}</dd>
            </div>

            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pagamento efetuado</dt>
                <dd class="text-lg font-semibold">{{ $reserve->paid_at ? \Carbon\Carbon::parse($reserve->paid_at)->format('d/m/Y') : 'Não foi efetuado' }}</dd>
            </div>

            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                <dd class="text-lg font-semibold">{{ $reserve->status }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
