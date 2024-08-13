<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Reserva</title>
    <style>
        .hidden-fields {
            display: none;
        }
    </style>
</head>
<body>

<div id="noAuth-create-crud-modal" tabindex="-1" aria-hidden="true"
     class="{{ session('error') ? 'flex' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75"
     data-modal-target="noAuth-create-crud-modal">
    <div class="relative p-4 w-full max-w-7xl h-auto max-h-[90vh]">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 overflow-y-auto max-h-full">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-slate-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Solicitar Reserva</h3>
                <button id="noAuth-close-modal-button" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="noAuth-create-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>


            <!-- Modal body -->
            <form id="noAuth-create-reserve-form" action="{{ route('visitorCalendar.store') }}" method="post"
                  class="px-4 space-y-4">
                @csrf
                <div class="max-w-sm m-2">
                    <label for="noAuth-email"
                           class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="noAuth-email" value="{{ old('email') }}"
                               class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="email@exemplo.com"/>
                        <button type="button" id="noAuth-search-button"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Procurar
                        </button>
                    </div>
                    <div id="email-error" class="text-red-500 text-sm mb-2"></div>
                </div>
                @if(session('error'))
                    <div
                        class="error-message p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Erro:</span> {{ session('error') }}
                    </div>
                @endif
                <div class="hidden-fields grid grid-cols-12 gap-4">
                    <!-- User Information -->
                    <div class="border-r col-span-6 dark:border-gray-600 pb-6 pr-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Cadastro do
                            Usuário</h4>

                        <div class="hidden-fields grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- User Fields -->
                            <div class="hidden-fields">
                                <label for="noAuth-name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                <input type="text" name="name" id="noAuth-name" value="{{ old('name') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome completo"/>
                                <div id="name-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div class="hidden-fields">
                                <label for="noAuth-phone"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 top-0 flex items-center pl-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                            <path
                                                d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                        </svg>
                                    </div>
                                    <input type="tel" name="phone" id="noAuth-phone" value="{{ old('phone') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="(99) 99999-9999"/>
                                </div>
                                <div id="phone-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div class="hidden-fields">
                                <label for="noAuth-cpf_cnpj"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF/CNPJ</label>
                                <input type="text" name="cpf_cnpj" id="noAuth-cpf_cnpj" value="{{ old('cpf_cnpj') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="000.000.000-00 / 00.000.000/0000-00"/>
                                <div id="cpf_cnpj-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div class="hidden-fields">
                                <label for="noAuth-company"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                                <input type="text" name="company" id="noAuth-company" value="{{ old('company') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome da empresa"/>
                                <div id="company-error" class="text-red-500 text-sm"></div>
                            </div>
                        </div>
                        <div class="hidden-fields">
                            <h4 class="mt-4 text-lg font-medium text-gray-900 dark:text-white mb-2">Cadastro de
                                Endereço</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Address Fields -->
                                <div>
                                    <label for="noAuth-zipcode"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                    <input type="text" name="zipcode" id="noAuth-zipcode" value="{{ old('zipcode') }}"
                                           class="zipcode-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="00000-000"/>
                                    <div id="zipcode-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-country"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                    <input type="text" name="country" id="noAuth-country" value="{{ old('country') }}"
                                           class="country-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Brasil"/>
                                    <div id="country-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-state"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                    <input type="text" name="state" id="noAuth-state" value="{{ old('state') }}"
                                           class="state-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="SP"/>
                                    <div id="state-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-city"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                    <input type="text" name="city" id="noAuth-city" value="{{ old('city') }}"
                                           class="city-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Nome da cidade"/>
                                    <div id="city-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-neighborhood"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                    <input type="text" name="neighborhood" id="noAuth-neighborhood"
                                           value="{{ old('neighborhood') }}"
                                           class="neighborhood-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Nome do bairro"/>
                                    <div id="neighborhood-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-street"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                    <input type="text" name="street" id="noAuth-street" value="{{ old('street') }}"
                                           class="street-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Nome da rua"/>
                                    <div id="street-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-number"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                    <input type="text" name="number" id="noAuth-number" value="{{ old('number') }}"
                                           class="number-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Número do local"/>
                                    <div id="number-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="noAuth-complement"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                                    <input type="text" name="complement" id="noAuth-complement"
                                           value="{{ old('complement') }}"
                                           class="complement-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                           placeholder="Apto, Bloco, etc."/>
                                    <div id="complement-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6">
                        <div class="hidden-fields">
                            <h4 class="hidden-fields text-lg font-medium text-gray-900 dark:text-white mb-2">Solicitar
                                Reserva</h4>
                            <label for="noAuth-title"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título da
                                Reserva</label>
                            <input type="text" name="title" id="noAuth-title" value="{{ old('title') }}"
                                   class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                   placeholder="Título do evento"/>
                            <div id="title-error" class="text-red-500 text-sm"></div>
                        </div>

                        <div class="md:col-span-2 hidden-fields mt-4">
                            <label for="noAuth-description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descreva a
                                organização
                                da sala</label>
                            <textarea name="description" id="noAuth-description"
                                      class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                      placeholder="Descreva a organização da sala">{{ old('description') }}</textarea>
                            <div id="description-error" class="text-red-500 text-sm"></div>
                        </div>

                        <div class="hidden-fields grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="noAuth-start"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                                    de Início</label>
                                <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="noAuth-start" datepicker type="text" name="start" autocomplete="off"
                                           value="{{ old('start') }}"
                                           class="guest-start datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Selecione uma data">
                                </div>
                                <div id="noAuth-start-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div>
                                <label for="noAuth-end"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                                    de Fim</label>
                                <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input id="noAuth-end" datepicker type="text" name="end" autocomplete="off"
                                           value="{{ old('end') }}"
                                           class="guest-end datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Selecione uma data">
                                </div>
                                <div id="noAuth-end-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div>
                                <label for="noAuth-start_time"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de
                                    Início</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                  d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <input type="time" id="noAuth-start_time" name="start_time"
                                           value="{{ old('start_time') }}"
                                           class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                    <div id="start_time-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>

                            <div>
                                <label for="noAuth-end_time"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de
                                    Fim</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                  d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <input type="time" id="noAuth-end_time" name="end_time"
                                           value="{{ old('end_time') }}"
                                           class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                    <div id="end_time-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>

                            <div>
                                <label for="noAuth-rental_item_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                                <select id="noAuth-rental_item_id" name="rental_item_id"
                                        class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="" selected disabled></option>
                                    @foreach($bookItems as $bookItem)
                                        <option
                                            value="{{ $bookItem->id }}" {{ old('rental_item_id') == $bookItem->id ? 'selected' : '' }}>{{ $bookItem->name }}</option>
                                    @endforeach
                                </select>
                                <div id="rental_item_id-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div>
                                <label for="noAuth-payment_type"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma de
                                    pagamento</label>
                                <select id="noAuth-payment_type" name="payment_type"
                                        class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="Pix" {{ old('payment_type') == 'Pix' ? 'selected' : '' }}>Pix
                                    </option>
                                    <option value="Cartao" {{ old('payment_type') == 'Cartao' ? 'selected' : '' }}>
                                        Cartão
                                    </option>
                                    <option value="Boleto" {{ old('payment_type') == 'Boleto' ? 'selected' : '' }}>
                                        Boleto
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-center md:col-span-2">
                                <input id="noAuth-terms-checkbox" type="checkbox" value=""
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ old('terms') ? 'checked' : '' }}>
                                <label for="noAuth-terms-checkbox"
                                       class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Eu
                                    aceito os
                                    termos de uso <a href="https://www.google.com.br/?hl=pt-BR"
                                                     class="text-blue-600 dark:text-blue-500 hover:underline">termos e
                                        condições</a>.</label>
                            </div>
                        </div>
                        <div class="hidden-fields flex justify-end mt-4">
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
