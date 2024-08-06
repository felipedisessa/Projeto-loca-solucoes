@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="p-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center mb-4 md:mb-0">
            <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
            </svg>
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <div class="w-full mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <!-- Title above profile picture -->
                    <div class="flex justify-center mb-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Foto de perfil') }}</h3>
                    </div>

                    <!-- Display user's profile picture -->
                    @if ($user->uploads->isNotEmpty())
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset($user->uploads->first()->file_path) }}"
                                 class="w-32 h-32 rounded-full object-cover"
                                 alt="{{ $user->name }}">
                        </div>
                    @else
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/avatar.jpg') }}"
                                 class="w-32 h-32 rounded-full object-cover"
                                 alt="{{ $user->name }}">
                        </div>
                    @endif

                    <!-- Profile Image Upload Form -->
                    <form method="POST" action="{{ route('profile.updateImage') }}"
                          enctype="multipart/form-data"
                          class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="profile_image">Imagem</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="profile_image" name="profile_image" type="file">
                            <div id="profile_image-error" class="text-red-600"></div>
                        </div>

                        <div class="flex items-center justify-end space-x-2">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </form>
                    @if ($user->uploads->isNotEmpty())
                        <form method="POST" action="{{ route('profile.deleteImage') }}">
                            @csrf
                            @method('DELETE')
                            <div class="flex items-center justify-end space-x-2 mt-4">
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                    {{ __('Excluir') }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        const maxImageSize = 2048 * 1024; // 2048KB

        function validateImage(input) {
            const file = input.files[0];
            const errorDiv = document.getElementById('profile_image-error');

            if (!allowedImageTypes.includes(file.type)) {
                errorDiv.textContent = 'Apenas arquivos JPEG, PNG, JPG, GIF e SVG são permitidos.';
                return false;
            } else if (file.size > maxImageSize) {
                errorDiv.textContent = 'O tamanho do arquivo não deve exceder 2048KB.';
                return false;
            } else {
                errorDiv.textContent = '';
                return true;
            }
        }

        const profileImageInput = document.getElementById('profile_image');
        if (profileImageInput) {
            profileImageInput.addEventListener('change', function () {
                validateImage(this);
            });
        }

        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (event) {
                if (!validateImage(profileImageInput)) {
                    event.preventDefault();
                }
            });
        }
    });
</script>
