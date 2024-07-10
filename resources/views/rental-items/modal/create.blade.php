<!-- Main modal -->
<div id="create-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative p-4 w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Cadastrar Item</h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="create-rental-item-form" action="{{ route('rental-items.store') }}" method="post"
                  class="p-4 space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proprietário</label>
                        <select id="user_id" name="user_id"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled>Proprietário</option>
                            @foreach($landLordUsers as $landLordUser)
                                <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="name-error" class="text-red-600"></div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea name="description" id="description"
                                  class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                        <div id="description-error" class="text-red-600"></div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="rental_item_notes"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                        <input type="text" name="rental_item_notes" id="rental_item_notes"
                               value="{{ old('rental_item_notes') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div>
                        <label for="status"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled></option>
                            <option value="1">Disponível</option>
                            <option value="2">Reservado</option>
                            <option value="3">Manutenção</option>
                        </select>
                        <div id="status-error" class="text-red-600"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="price_per_hour"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
                            hora</label>
                        <input type="text" name="price_per_hour" id="price_per_hour" value="{{ old('price_per_hour') }}"
                               class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="price_per_hour-error" class="text-red-600"></div>
                    </div>

                    <div>
                        <label for="price_per_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor
                            por dia</label>
                        <input type="text" name="price_per_day" id="price_per_day" value="{{ old('price_per_day') }}"
                               class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="price_per_day-error" class="text-red-600"></div>
                    </div>

                    <div>
                        <label for="price_per_month"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
                            mês</label>
                        <input type="text" name="price_per_month" id="price_per_month"
                               value="{{ old('price_per_month') }}"
                               class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="price_per_month-error" class="text-red-600"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="street"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                        <input type="text" name="street" id="street" value="{{ old('street') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="street-error" class="text-red-600"></div>
                    </div>

                    <div>
                        <label for="number"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                        <input type="text" name="number" id="number" value="{{ old('number') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="number-error" class="text-red-600"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="neighborhood" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                        <input type="text" name="neighborhood" id="neighborhood" value="{{ old('neighborhood') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div>
                        <label for="city"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="city-error" class="text-red-600"></div>
                    </div>

                    <div>
                        <label for="state"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <input type="text" name="state" id="state" value="{{ old('state') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="state-error" class="text-red-600"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="zipcode"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                        <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="zipcode-error" class="text-red-600"></div>
                    </div>

                    <div>
                        <label for="country"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                        <input type="text" name="country" id="country" value="{{ old('country') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                        <div id="country-error" class="text-red-600"></div>
                    </div>

                    <div class="md:col-span-3">
                        <label for="complement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento
                            de endereço</label>
                        <input type="text" name="complement" id="complement" value="{{ old('complement') }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>
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
