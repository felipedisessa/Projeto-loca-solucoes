<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuário :: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="m-4 max-w-lg mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                <dd class="text-lg font-semibold">{{ $user->name }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">E-mail</dt>
                <dd class="text-lg font-semibold">{{ $user->email }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                <dd class="text-lg font-semibold">{{ $user->phone }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Celular</dt>
                <dd class="text-lg font-semibold">{{ $user->mobile }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Permissão</dt>
                <dd class="text-lg font-semibold">{{ $user->role }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Documento</dt>
                <dd class="text-lg font-semibold">{{ $user->cpf_cnpj }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Observações</dt>
                <dd class="text-lg font-semibold">{{ $user->user_notes ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Empresa</dt>
                <dd class="text-lg font-semibold">{{ $user->company ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                <dd class="text-lg font-semibold">{{ $user->address->street ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Numero</dt>
                <dd class="text-lg font-semibold">{{ $user->address->number ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Complemento</dt>
                <dd class="text-lg font-semibold">{{ $user->address->complement ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                <dd class="text-lg font-semibold">{{ $user->address->neighborhood ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                <dd class="text-lg font-semibold">{{ $user->address->city ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Estado</dt>
                <dd class="text-lg font-semibold">{{ $user->address->state ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                <dd class="text-lg font-semibold">{{ $user->address->zipcode ?? 'Não informado' }}</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pais</dt>
                <dd class="text-lg font-semibold">{{ $user->address->country ?? 'Não informado' }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
