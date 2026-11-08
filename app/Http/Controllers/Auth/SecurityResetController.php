<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SecurityResetController extends Controller
{
    // 1. Mostrar formulario para ingresar el correo
    public function showEmailForm()
    {
        return view('auth.forgot-email');
    }

    // 2. Buscar al usuario y mostrar su pregunta
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'No existe ningún usuario con este correo.'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->pregunta_seguridad) {
            return back()->withErrors(['email' => 'Este usuario no tiene una pregunta de seguridad configurada.']);
        }

        return redirect()->route('password.security.question', $user->email);
    }

    // 3. Mostrar la pregunta de seguridad
    public function showQuestion($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return view('auth.forgot-question', compact('user'));
    }

    // 4. Verificar respuesta y cambiar contraseña
    public function resetPassword(Request $request, $email)
    {
        $request->validate([
            'respuesta_seguridad' => 'required|string',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('email', $email)->firstOrFail();

        // Verificar que la respuesta coincida con la guardada (encriptada)
        if (!Hash::check($request->respuesta_seguridad, $user->respuesta_seguridad)) {
            return back()->withErrors(['respuesta_seguridad' => 'La respuesta de seguridad es incorrecta.']);
        }

        // Actualizar contraseña
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Contraseña actualizada exitosamente. Ya puedes iniciar sesión.');
    }
}