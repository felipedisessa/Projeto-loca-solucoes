@php
    use Carbon\Carbon;
    use App\Enum\RoleEnum;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                {{ __('Usuário :: ') . $user->name }}
            </h2>
            <a href="{{ route('users.index') }}"
               class="p-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>
    <div
        class="m-4 max-w-4xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-900 dark:text-white">
            <div>
                <h3 class="text-lg font-semibold mb-4">Dados Pessoais</h3>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                    @if ($user->uploads->isNotEmpty())
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset($user->uploads->first()->file_path) }}"
                                 class="w-32 h-32 rounded-full object-cover"
                                 alt="{{ $user->name }}">
                        </div>
                    @endif
                    @foreach([
                        'Nome' => $user->name,
                        'E-mail' => $user->email,
                        'Telefone' => $user->phone,
                        'Permissão' => RoleEnum::from($user->role)->label(),
                        'Documento' => $user->cpf_cnpj,
                        'Empresa' => $user->company ?? 'Não informado',
                        'Observações' => $user->user_notes ?? 'Não informado',
                        'Data de Criação' => $user->created_at->format('d/m/Y'),
                        'Última Atualização' => $user->updated_at->format('d/m/Y')
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
                        'Rua' => $user->address->street ?? 'Não informado',
                        'Número' => $user->address->number ?? 'Não informado',
                        'Complemento' => $user->address->complement ?? 'Não informado',
                        'Bairro' => $user->address->neighborhood ?? 'Não informado',
                        'Cidade' => $user->address->city ?? 'Não informado',
                        'Estado' => $user->address->state ?? 'Não informado',
                        'CEP' => $user->address->zipcode ?? 'Não informado',
                        'País' => $user->address->country ?? 'Não informado'
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
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Quantidade de
                                Reservas
                            </dt>
                            <dd class="text-lg font-semibold">{{ $user->reserves_count }}</dd>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Última
                                Reserva
                            </dt>
                            <dd class="text-lg font-semibold">
                                @if($user->last_reserve && strtotime($user->last_reserve))
                                    {{ Carbon::parse($user->last_reserve)->format('d/m/Y') }}
                                @else
                                    Não disponível
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Reservas
                                Canceladas
                            </dt>
                            <dd class="text-lg font-semibold">{{ $user->reserves_cancelled_count }}</dd>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Reservas
                                Ativas
                            </dt>
                            <dd class="text-lg font-semibold">{{ $user->reserves_active_count }}</dd>
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
                            <dt class="text-lg font-semibold text-gray-500 md:text-lg dark:text-gray-400">Total Gasto
                            </dt>
                            <dd class="text-lg font-semibold">
                                R$ {{ number_format($user->total_spent, 2, ',', '.') }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
