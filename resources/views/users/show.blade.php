<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuário :: ') . $user->name }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-white">
            <!-- Dados Pessoais -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Dados Pessoais</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold">{{ $user->name }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">E-mail</dt>
                        <dd class="text-lg font-semibold">{{ $user->email }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                        <dd class="text-lg font-semibold">{{ $user->phone }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Celular</dt>
                        <dd class="text-lg font-semibold">{{ $user->mobile }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Permissão</dt>
                        <dd class="text-lg font-semibold">{{ $user->role }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Documento</dt>
                        <dd class="text-lg font-semibold">{{ $user->cpf_cnpj }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Empresa</dt>
                        <dd class="text-lg font-semibold">{{ $user->company ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold">{{ $user->user_notes ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Data de Criação</dt>
                        <dd class="text-lg font-semibold">{{ $user->created_at->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Última Atualização</dt>
                        <dd class="text-lg font-semibold">{{ $user->updated_at->format('d/m/Y') }}</dd>
                    </div>
                </div>
            </div>

            <!-- Endereço -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Endereço</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->street ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Número</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->number ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Complemento</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->complement ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->neighborhood ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->city ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">Estado</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->state ?? 'Não informado' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->zipcode ?? 'Não informado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">País</dt>
                        <dd class="text-lg font-semibold">{{ $user->address->country ?? 'Não informado' }}</dd>
                    </div>
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
