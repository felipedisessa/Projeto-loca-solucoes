<!-- Main modal -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative p-4 w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Item
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-rental-item-form" action="{{ route('rental-items.update', $rentalItem->id) }}" method="post" class="p-4 space-y-4">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="update-user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proprietário</label>
                        <select id="update-user_id" name="user_id" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled>Proprietário</option>
                            @foreach($landLordUsers as $landLordUser)
                                <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="update-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="name" id="update-name" value="{{ $rentalItem->name }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                    </div>

                    <div class="md:col-span-2">
                        <label for="update-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <input type="text" name="description" id="update-description" value="{{ $rentalItem->description }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                    </div>

                    <div class="md:col-span-2">
                        <label for="update-rental_item_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                        <input type="text" name="rental_item_notes" id="update-rental_item_notes" value="{{ $rentalItem->rental_item_notes }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled>Status</option>
                            <option value="1">Disponível</option>
                            <option value="2">Reservado</option>
                            <option value="3">Manutenção</option>
                        </select>
                    </div>

                    <div>
                        <label for="update-price_per_hour" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por hora</label>
                        <input type="text" name="price_per_hour" id="update-price_per_hour" value="{{ $rentalItem->price_per_hour }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                    </div>

                    <div>
                        <label for="update-price_per_day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por dia</label>
                        <input type="text" name="price_per_day" id="update-price_per_day" value="{{ $rentalItem->price_per_day }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                    </div>

                    <div>
                        <label for="update-price_per_month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por mês</label>
                        <input type="text" name="price_per_month" id="update-price_per_month" value="{{ $rentalItem->price_per_month }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="update-street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                        <input type="text" name="street" id="update-street" value="{{ $rentalItem->address->street ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="update-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                        <input type="text" name="number" id="update-number" value="{{ $rentalItem->address->number ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="update-neighborhood" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                        <input type="text" name="neighborhood" id="update-neighborhood" value="{{ $rentalItem->address->neighborhood ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="update-city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                        <input type="text" name="city" id="update-city" value="{{ $rentalItem->address->city ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="update-state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <input type="text" name="state" id="update-state" value="{{ $rentalItem->address->state ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="update-zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                        <input type="text" name="zipcode" id="update-zipcode" value="{{ $rentalItem->address->zipcode ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="update-country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                        <input type="text" name="country" id="update-country" value="{{ $rentalItem->address->country ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div class="md:col-span-3">
                        <label for="update-complement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento de endereço</label>
                        <input type="text" name="complement" id="update-complement" value="{{ $rentalItem->address->complement ?? '' }}" class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>