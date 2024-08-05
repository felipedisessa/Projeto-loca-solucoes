<!-- Main modal -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative w-full max-w-2xl p-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Item
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-rental-item-form" action="{{ route('rental-items.update', $rentalItem->id) }}"
                  enctype="multipart/form-data" method="post"
                  class="p-4 space-y-4">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-r border-gray-300 dark:border-gray-600 pr-6">
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Cadastro do Item de
                            Locação</h4>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="update-user_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proprietário</label>
                                <select id="update-user_id" name="user_id"
                                        class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="" selected disabled>Proprietário</option>
                                    @foreach($landLordUsers as $landLordUser)
                                        <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                                    @endforeach
                                </select>
                                <div id="owner-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div>
                                <label for="update-name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                <input type="text" name="name" id="update-name" value="{{ $rentalItem->name }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                <div id="name-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div>
                                <label for="update-description"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                                <textarea name="description" id="update-description"
                                          class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >{{ $rentalItem->description }}</textarea>
                                <div id="description-error" class="text-red-500 text-sm"></div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label for="update-price_per_hour"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor
                                        por hora</label>
                                    <input type="text" name="price_per_hour" id="update-price_per_hour"
                                           value="{{ $rentalItem->formatted_price_per_hour }}"
                                           class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    />
                                    <div id="price_per_hour-error" class="text-red-500 text-sm"></div>
                                </div>

                                <div>
                                    <label for="update-price_per_day"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor
                                        por dia</label>
                                    <input type="text" name="price_per_day" id="update-price_per_day"
                                           value="{{ $rentalItem->formatted_price_per_day }}"
                                           class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    />
                                    <div id="price_per_day-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label for="update-price_per_month"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor
                                        por mês</label>
                                    <input type="text" name="price_per_month" id="update-price_per_month"
                                           value="{{ $rentalItem->formatted_price_per_month }}"
                                           class="mask-money block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    />
                                    <div id="price_per_month-error" class="text-red-500 text-sm"></div>
                                </div>
                                <div>
                                    <label for="update-status"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                    <select id="update-status" name="status"
                                            class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        @foreach ($statusOptions as $option)
                                            <option value="{{ $option['value'] }}"
                                                    @if ($rentalItem->status === $option['value']) selected @endif>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="status-error" class="text-red-500 text-sm"></div>
                                </div>
                            </div>

                            <div>
                                <label for="update-rental_item_notes"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                                <textarea name="rental_item_notes" id="update-rental_item_notes"
                                          class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $rentalItem->rental_item_notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Cadastro de Endereço do
                            Item</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="update-country"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                <input type="text" name="country" id="update-country"
                                       value="{{ $rentalItem->address->country ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="country-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-zipcode"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                <input type="text" name="zipcode" id="update-zipcode"
                                       value="{{ $rentalItem->address->zipcode ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="zipcode-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-state"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <input type="text" name="state" id="update-state"
                                       value="{{ $rentalItem->address->state ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="state-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-city"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                <input type="text" name="city" id="update-city"
                                       value="{{ $rentalItem->address->city ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="city-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-neighborhood"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                <input type="text" name="neighborhood" id="update-neighborhood"
                                       value="{{ $rentalItem->address->neighborhood ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="neighborhood-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-street"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                <input type="text" name="street" id="update-street"
                                       value="{{ $rentalItem->address->street ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="street-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="update-number"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                <input type="text" name="number" id="update-number"
                                       value="{{ $rentalItem->address->number ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="number-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div class="md:col-span-2">
                                <label for="update-complement"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento
                                    de endereço</label>
                                <input type="text" name="complement" id="update-complement"
                                       value="{{ $rentalItem->address->complement ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                       for="update-file_input">Imagem</label>
                                <figure
                                    class="m-2 relative w-full max-w-[8rem] h-[5rem] transition-all duration-300 cursor-pointer ">
                                    <img id="update-image-preview"
                                         class="hidden rounded-lg h-[5rem] w-full max-w-[8rem]" src=""
                                         alt="image description">
                                    <div id="update-placeholder-image" role="status"
                                         class="w-32 max-w-[8rem] max-h-full h-[5rem] space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                                        <div
                                            class="flex items-center justify-center max-w-[8rem] w-full max-h-full h-[5rem] bg-slate-300 rounded dark:bg-slate-800">
                                            <svg class="w-10 h-10 text-slate-200 dark:text-slate-600" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 18">
                                                <path
                                                    d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </figure>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="update-file_input" type="file" name="rental_item_image">
                                <div id="rental_item_image-error" class="text-red-600"></div>
                            </div>
                        </div>
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
