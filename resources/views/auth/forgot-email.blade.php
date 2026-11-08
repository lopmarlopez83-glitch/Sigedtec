<x-guest-layout>
    <h2 class="text-xl font-bold mb-4 text-center">Recuperar Contraseña</h2>
    <p class="text-sm text-gray-600 mb-4 text-center">Ingresa tu correo para buscar tu pregunta de seguridad.</p>

    <form method="POST" action="{{ route('password.security.check') }}">
        @csrf
        <div>
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="flex justify-center mt-4">
            <x-primary-button>Buscar Pregunta</x-primary-button>
        </div>
    </form>
</x-guest-layout>