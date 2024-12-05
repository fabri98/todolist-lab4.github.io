<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md mt-10">
        <!-- Título de Bienvenida -->
        <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-white mb-6">
            {{ __('Bienvenido de nuevo') }}
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="flex flex-col items-center bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-sm mx-auto">
        <!-- Formulario de Inicio de Sesión -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email"
                    class="block w-full mt-1 p-2 border rounded-lg dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password"
                    class="block w-full mt-1 p-2 border rounded-lg dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me y Olvidaste tu contraseña? -->
            <div class="flex justify-between items-center mt-4">
                <label for="remember_me" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        name="remember">
                    <span class="ml-2">{{ __('Recuérdame') }} </span>
                </label>
                
            </div>

            <!-- Botón de Inicio de Sesión y Enlace de Registro -->
            <div class="flex flex-col items-center mt-6 w-full">
                <x-primary-button
                    class="py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 text-center">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('¿No tienes una cuenta?') }}
                    <a href="{{ route('register') }}"
                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-500">
                        {{ __('Regístrate aquí') }}
                    </a>
                </p>
            </div>


        </form>
    </div>

    </div>
</x-guest-layout>