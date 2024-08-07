<!-- Main modal -->
<div id="create-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center
     w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative w-full max-w-2xl p-4 h-full md:h-auto max-h-[100vh]">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Cadastrar Usuário</h3>
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
            <form id="user-form" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                  class="p-4 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border-r border-gray-300 dark:border-gray-600 pr-6">
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Cadastro do Usuário</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome completo"/>
                                <div id="name-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="email@exemplo.com"/>
                                <div id="email-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="company"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome da empresa"/>
                                <div id="company-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="password"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="password-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 top-0 flex items-center pl-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                            <path
                                                d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="phone-input" name="phone" value="{{ old('name') }}"
                                           aria-describedby="helper-text-explanation"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="(99) 99999-9999"/>
                                </div>
                                <div id="phone-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="role"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                                <select id="role" name="role"
                                        class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="visitor">Visitante</option>
                                    <option value="landlord">Proprietário</option>
                                    <option value="admin">Administrador</option>
                                    <option value="tenant">Morador</option>
                                </select>
                            </div>
                            <div>
                                <label for="cpf_cnpj"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Documento</label>
                                <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{ old('cpf_cnpj') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="000.000.000-00 / 00.000.000/0000-00"/>
                                <div id="cpf_cnpj-error" class="text-red-600"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Cadastro de Endereço</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="zipcode"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="00000-000"/>
                                <div id="zipcode-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="country"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                <input type="text" name="country" id="country" value="{{ old('country') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Brasil"/>
                                <div id="country-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="state"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <input type="text" name="state" id="state" value="{{ old('state') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="SP"/>
                                <div id="state-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="city"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome da cidade"/>
                                <div id="city-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="neighborhood"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                <input type="text" name="neighborhood" id="neighborhood"
                                       value="{{ old('neighborhood') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome do bairro"/>
                                <div id="neighborhood-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="street"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                <input type="text" name="street" id="street" value="{{ old('street') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Nome da rua"/>
                                <div id="street-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="number"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                <input type="text" name="number" id="number" value="{{ old('number') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Número do local"/>
                                <div id="number-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div>
                                <label for="complement"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                                <input type="text" name="complement" id="complement" value="{{ old('complement') }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                       placeholder="Apto, Bloco, etc."/>
                                <div id="complement-error" class="text-red-500 text-sm"></div>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                       for="file_input">Foto de perfil</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file_input" type="file" name="profile_image">
                                <div id="profile_image-error" class="text-red-600"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="user_notes"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notas</label>
                    <textarea name="user_notes" id="user_notes"
                              class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                              placeholder="Observações adicionais"></textarea>
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
