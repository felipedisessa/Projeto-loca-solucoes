<!-- Main modal -->
<div id="edit-crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-gray-800 bg-opacity-75">
    <div class="relative p-4 w-full max-w-4xl">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
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
                  class="p-4 space-y-4">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
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
                            {{--                            <div>--}}
                            {{--                                <label for="update-password"--}}
                            {{--                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>--}}
                            {{--                                <input type="password" name="password" id="update-password"--}}
                            {{--                                       value="{{ old('password') }}"--}}
                            {{--                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"--}}
                            {{--                                       placeholder=" ">--}}
                            {{--                                <div id="password-error" class="text-red-600"></div>--}}
                            {{--                            </div>--}}
                            <div>
                                <label for="update-phone"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                <input type="tel" name="phone" id="update-phone" value="{{ $user->phone }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="phone-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-mobile"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Celular</label>
                                <input type="tel" name="mobile" id="update-mobile" value="{{ $user->mobile }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="mobile-error" class="text-red-600"></div>
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
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edição de Endereço</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="update-country"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                <input type="text" name="country" id="update-country"
                                       value="{{ $user->address->country ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="country-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-zipcode"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                <input type="text" name="zipcode" id="update-zipcode"
                                       value="{{ $user->address->zipcode ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="zipcode-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-state"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <input type="text" name="state" id="update-state"
                                       value="{{ $user->address->state ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="state-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-city"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                <input type="text" name="city" id="update-city" value="{{ $user->address->city ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="city-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-neighborhood"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                <input type="text" name="neighborhood" id="update-neighborhood"
                                       value="{{ $user->address->neighborhood ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="neighborhood-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-street"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                <input type="text" name="street" id="update-street"
                                       value="{{ $user->address->street ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="street-error" class="text-red-600"></div>
                            </div>
                            <div>
                                <label for="update-number"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                <input type="text" name="number" id="update-number"
                                       value="{{ $user->address->number ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
                                <div id="number-error" class="text-red-600"></div>
                            </div>
                            <div class="md:col-span-2">
                                <label for="update-complement"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento
                                    de
                                    endereço</label>
                                <input type="text" name="complement" id="update-complement"
                                       value="{{ $user->address->complement ?? '' }}"
                                       class="block w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
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
