<!-- Main modal -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-slate-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Editar Usuário</h3>
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
            <form id="edit-user-form" action="{{ route('users.update', $user->id) }}" method="post"
                  enctype="multipart/form-data"
                  class="p-4 space-y-4">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-r border-gray-300 dark:border-gray-600 pr-6">
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edição do Usuário</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="update-name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                <input type="text" name="name" id="update-name" value="{{ $user->name }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                <div id="name-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                                <input type="email" name="email" id="update-email" value="{{ $user->email }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                <div id="email-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-company"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                                <input type="text" name="company" id="update-company" value="{{ $user->company }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                <div id="company-error" class="text-red-600"></div>
                            </div>

                            <div>
                                <label for="update-phone"
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
                                    <input type="tel" name="phone" id="update-phone" value="{{ $user->phone }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="(99) 99999-9999"/>
                                </div>
                                <div id="phone-error" class="text-red-600"></div>
                            </div>
                            @php
                                use App\Enum\RoleEnum;
                            @endphp
                            <div>
                                <label for="update-role"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                                <select id="update-role" name="role"
                                        class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="{{ $user->role }}"
                                            selected>{{ RoleEnum::from($user->role)->label() }}</option>
                                    @foreach(RoleEnum::options() as $option)
                                        @if($option['value'] !== $user->role)
                                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="role-error" class="text-red-600"></div>
                            </div>

                            <div>
                                <label for="update-cpf_cnpj"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Documento</label>
                                <input type="text" name="cpf_cnpj" id="update-cpf_cnpj" value="{{ $user->cpf_cnpj }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="cpf_cnpj-error" class="text-red-600"></div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                       for="update-file_input">Foto de perfil</label>
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
                                    id="update-file_input" type="file" name="profile_image">
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edição de Endereço</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="update-zipcode"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                <input type="text" name="zipcode" id="update-zipcode"
                                       value="{{ $user->address->zipcode ?? '' }}"
                                       class="zipcode-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="zipcode-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-country"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                <input type="text" name="country" id="update-country"
                                       value="{{ $user->address->country ?? '' }}"
                                       class="country-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="country-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-state"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <input type="text" name="state" id="update-state"
                                       value="{{ $user->address->state ?? '' }}"
                                       class="state-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="state-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-city"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                <input type="text" name="city" id="update-city" value="{{ $user->address->city ?? '' }}"
                                       class="city-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="city-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-neighborhood"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                <input type="text" name="neighborhood" id="update-neighborhood"
                                       value="{{ $user->address->neighborhood ?? '' }}"
                                       class="neighborhood-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="neighborhood-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-street"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                <input type="text" name="street" id="update-street"
                                       value="{{ $user->address->street ?? '' }}"
                                       class="street-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="street-error" class="text-red-600"></div>
                            </div>

                            <div>
                                <label for="update-number"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                <input type="text" name="number" id="update-number"
                                       class="number-input block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="number-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="complement"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                                <input type="text" name="complement" id="update-complement"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                <div id="complement-error" class="text-red-500 text-sm"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="update-user_notes"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notas</label>
                    <textarea name="user_notes" id="update-user_notes"
                              class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $user->user_notes }}</textarea>
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
