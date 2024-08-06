<!-- Main modal -->
<div id="guest-create-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50
    justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75"
     data-modal-target="guest-create-crud-modal">
    <div class="relative p-4 w-full max-w-3xl h-auto max-h-[90vh]">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Cadastrar Reserva Externa</h3>
                <button id="guest-close-modal-button" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="guest-create-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="guest-create-reserve-form" action="{{ route('reserves.store') }}" method="post"
                  class="p-4 space-y-4">
                @csrf
                @if(session('error'))
                    <div class="border-r border-gray-300 dark:border-gray-600 pr-6">
                        class="error-message p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200
                        dark:text-red-800"
                        role="alert">
                        <span class="font-medium">Erro:</span> {{ session('error') }}
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="guest-user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsável</label>
                        <input type="hidden" id="guest-user_id" name="user_id" value="{{ $user->id }}">
                        <input type="text" value="{{ $user->name }}" disabled
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <div id="user_id-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="guest-title"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                        <input type="text" name="title" id="guest-title" value="{{ old('title') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="title-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="guest-description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descreva a
                            organização
                            da sala</label>
                        <textarea name="description" id="guest-description"
                                  class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                        <div id="description-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de
                            início</label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="start" datepicker type="text" name="start" value="{{ old('start') }}"
                                   autocomplete="off"
                                   class=" guest-start datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Selecione uma data">
                        </div>
                        <div id="start-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de
                            fim</label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="end" datepicker type="text" name="end" value="{{ old('end') }}"
                                   autocomplete="off"
                                   class="guest-end datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Selecione uma data">
                        </div>
                        <div id="end-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="guest-start_time"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora
                            de Início</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="time" id="guest-start_time" name="start_time" value="{{ old('start_time') }}"
                                   class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                            <div id="start_time-error" class="text-red-500 text-sm"></div>
                        </div>
                    </div>

                    <div>
                        <label for="guest-end_time"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora
                            de Fim</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="time" id="guest-end_time" name="end_time" value="{{ old('end_time') }}"
                                   class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                            <div id="end_time-error" class="text-red-500 text-sm"></div>
                        </div>
                    </div>

                    <div>
                        <label for="guest-rental_item_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                        <select id="guest-rental_item_id" name="rental_item_id"
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
                        <label for="guest-payment_type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma de
                            pagamento</label>
                        <select id="guest-payment_type" name="payment_type"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option
                                value="Nao se aplica" {{ old('payment_type') == 'Nao se aplica' ? 'selected' : '' }}>Não
                                se aplica
                            </option>
                            <option value="Pix" {{ old('payment_type') == 'Pix' ? 'selected' : '' }}>Pix</option>
                            <option value="Cartao" {{ old('payment_type') == 'Cartao' ? 'selected' : '' }}>Cartão
                            </option>
                            <option value="Boleto" {{ old('payment_type') == 'Boleto' ? 'selected' : '' }}>Boleto
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="link-checkbox" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Eu
                        aceito os
                        termos de uso <a href="https://www.google.com.br/?hl=pt-BR"
                                         class="text-blue-600 dark:text-blue-500 hover:underline">termos e
                            condições</a>.</label>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
