<!-- Main modal -->
<div id="guest-create-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative p-4 w-full max-w-2xl">
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
            <form id="create-reserve-form" action="{{ route('reserves.store') }}" method="post" class="p-4 space-y-4">
                @csrf

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
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea name="description" id="guest-description"
                                  class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                        <div id="description-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="guest-start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            de
                            início</label>
                        <input type="datetime-local" name="start" id="guest-start"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="start-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="guest-end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            de
                            fim</label>
                        <input type="datetime-local" name="end" id="guest-end"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="end-error" class="text-red-500 text-sm"></div>
                    </div>

                    <div>
                        <label for="guest-rental_item_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                        <select id="guest-rental_item_id" name="rental_item_id"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled></option>
                            @foreach($bookItems as $bookItem)
                                <option value="{{ $bookItem->id }}">{{ $bookItem->name }}</option>
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
                            <option value="Pix">Pix</option>
                            <option value="Cartao">Cartão</option>
                            <option value="Boleto">Boleto</option>
                        </select>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="status"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <input type="text" name="status" id="status" value="Pendente" readonly
                           class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                </div>

                <div class="flex items-center">
                    <input id="link-checkbox" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree
                        with the <a href="https://www.google.com.br/?hl=pt-BR"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">terms
                            and
                            conditions</a>.</label>
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
