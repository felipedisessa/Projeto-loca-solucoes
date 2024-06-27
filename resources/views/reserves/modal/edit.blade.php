<!-- Main modal -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative p-4 w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Reserva
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
            <form id="edit-reserve-form" action="{{ route('reserves.update', $reserve->id) }}" method="post"
                  class="p-4 space-y-4">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="update-user_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsável</label>
                        <select id="update-user_id" name="user_id"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" disabled>Responsável</option>
                            @foreach($bookUsers as $user)
                                <option
                                    value="{{ $user->id }}" {{ $reserve->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="update-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                        <input type="text" name="title" id="update-title" value="{{ $reserve->title }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div class="md:col-span-2">
                        <label for="update-description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea name="description" id="update-description"
                                  class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $reserve->description }}</textarea>
                    </div>

                    <div>
                        <label for="update-start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            de início</label>
                        <input type="datetime-local" name="start" id="update-start" value="{{$reserve->start}}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div>
                        <label for="update-end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            de fim</label>
                        <input type="datetime-local" name="end" id="update-end" value="{{$reserve->end}}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div>
                        <label for="update-rental_item_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item de
                            Aluguel</label>
                        <select id="update-rental_item_id" name="rental_item_id"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" disabled>Item de Aluguel</option>
                            @foreach($bookItems as $rental_item)
                                <option
                                    value="{{ $rental_item->id }}" {{ $reserve->rental_item_id == $rental_item->id ? 'selected' : '' }}>{{ $rental_item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="update-price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço</label>
                        <input type="text" name="price" id="update-price" value="{{ $reserve->price }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div>
                        <label for="update-payment_type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma de
                            pagamento</label>
                        <input type="text" name="payment_type" id="update-payment_type"
                               value="{{ $reserve->payment_type }}"
                               class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                    </div>

                    <div class="md:col-span-2">
                        <label for="update-status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="update-status"
                                class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="confirmado" {{ $reserve->status == 'confirmado' ? 'selected' : '' }}>
                                Confirmado
                            </option>
                            <option value="pendente" {{ $reserve->status == 'pendente' ? 'selected' : '' }}>Pendente
                            </option>
                            <option value="pago" {{ $reserve->status == 'pago' ? 'selected' : '' }}>Pago</option>
                            <option value="cancelado" {{ $reserve->status == 'cancelado' ? 'selected' : '' }}>
                                Cancelado
                            </option>
                        </select>
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
