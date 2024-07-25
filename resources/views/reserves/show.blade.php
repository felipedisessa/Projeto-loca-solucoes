<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                </svg>
                {{ __('Reserva :: ') . $reserve->title }}
            </h2>
            <a href="{{ route('reserves.index') }}"
               class="p-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div
        class="m-4 max-w-4xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-900 dark:text-white">
            <div>
                <h3 class="text-lg font-semibold mb-4">Responsável</h3>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                    @foreach(['Nome' => $reserve->user->name, 'Email' => $reserve->user->email, 'Empresa' => $reserve->user->company, 'Telefone' => $reserve->user->phone, 'Rua' => $reserve->user->address->street, 'Número' => $reserve->user->address->number, 'Bairro' => $reserve->user->address->neighborhood, 'Cidade' => $reserve->user->address->city, 'Estado' => $reserve->user->address->state, 'CEP' => $reserve->user->address->zipcode] as $label => $value)
                        <div class="mb-4">
                            <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-lg font-semibold">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Detalhes da Reserva</h3>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                    @foreach([
                        'Nome' => $reserve->title,
                        'Descrição' => $reserve->description,
                        'Hora de início' => \Carbon\Carbon::parse($reserve->start)->format('d/m/Y H:i'),
                        'Hora de fim' => \Carbon\Carbon::parse($reserve->end)->format('d/m/Y H:i'),
                        'Sala' => $reserve->rentalItem->name,
                        'Preço' => 'R$ ' . number_format($reserve->price, 2, ',', '.'),
                        'Forma de pagamento' => $reserve->payment_type,
                        'Pagamento efetuado' => $reserve->paid_at ? \Carbon\Carbon::parse($reserve->paid_at)->format('d/m/Y') : 'Não foi efetuado',
                        'Status' => $reserve->status
                    ] as $label => $value)
                        <div class="mb-4">
                            <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-lg font-semibold">{{ $value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>
        </dl>
    </div>
</x-app-layout>
