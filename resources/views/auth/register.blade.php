<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- 🔽 Pregunta de Seguridad -->
        <div class="mt-4">
            <x-input-label for="pregunta_seguridad" :value="__('Pregunta de Seguridad')" />
            <select id="pregunta_seguridad" name="pregunta_seguridad" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Seleccione una pregunta</option>
                <option value="¿Cuál es el nombre de tu primera mascota?" {{ old('pregunta_seguridad') == '¿Cuál es el nombre de tu primera mascota?' ? 'selected' : '' }}>¿Cuál es el nombre de tu primera mascota?</option>
                <option value="¿Cuál es el nombre de tu madre?" {{ old('pregunta_seguridad') == '¿Cuál es el nombre de tu madre?' ? 'selected' : '' }}>¿Cuál es el nombre de tu madre?</option>
                <option value="¿En qué ciudad naciste?" {{ old('pregunta_seguridad') == '¿En qué ciudad naciste?' ? 'selected' : '' }}>¿En qué ciudad naciste?</option>
            </select>
            <x-input-error :messages="$errors->get('pregunta_seguridad')" class="mt-2" />
        </div>

        <!-- 🔽 Respuesta de Seguridad -->
        <div class="mt-4">
            <x-input-label for="respuesta_seguridad" :value="__('Respuesta de Seguridad')" />
            <x-text-input id="respuesta_seguridad" class="block mt-1 w-full" type="text" name="respuesta_seguridad" :value="old('respuesta_seguridad')" required />
            <x-input-error :messages="$errors->get('respuesta_seguridad')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>