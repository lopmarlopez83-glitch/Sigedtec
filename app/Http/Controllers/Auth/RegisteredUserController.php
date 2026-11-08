<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 🔽 Validar pregunta y respuesta
            'pregunta_seguridad' => ['required', 'string', 'max:255'],
            'respuesta_seguridad' => ['required', 'string', 'max:255'],
        ]);

        // 🔽 BUSCAR EL ROL "SOLICITANTE"
        $roleSolicitante = Role::where('nombre', 'solicitante')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleSolicitante?->id,
            // 🔽 GUARDAR LA PREGUNTA Y LA RESPUESTA ENCRIPTADA
            'pregunta_seguridad' => $request->pregunta_seguridad,
            'respuesta_seguridad' => Hash::make($request->respuesta_seguridad),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}