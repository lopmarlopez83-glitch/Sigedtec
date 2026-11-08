<x-guest-layout>
    <h2 class="text-xl font-bold mb-4 text-center">Pregunta de Seguridad</h2>
    <p class="text-sm text-gray-600 mb-4 text-center">Responde correctamente para cambiar tu contraseña.</p>

    <form method="POST" action="{{ route('password.security.reset', $user->email) }}">
        @csrf
        
        <!-- Mostrar la pregunta guardada -->
        <div class="mb-4 p-3 bg-gray-100 rounded border">
            <strong>Tu pregunta:</strong> {{ $user->pregunta_seguridad }}
        </div>

        <!-- Campo para la respuesta -->
        <div class="mb-4">
            <x-input-label for="respuesta_seguridad" value="Respuesta" />
            <x-text-input id="respuesta_seguridad" class="block mt-1 w-full" type="text" name="respuesta_seguridad" required />
            <x-input-error :messages="$errors->get('respuesta_seguridad')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div class="mb-4">
            <x-input-label for="password" value="Nueva Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmación de la nueva contraseña -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex justify-center mt-4">
            <x-primary-button>Cambiar Contraseña</x-primary-button>
        </div>
    </form>
</x-guest-layout>