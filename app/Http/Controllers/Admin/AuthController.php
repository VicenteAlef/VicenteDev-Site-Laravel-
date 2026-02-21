<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;

class AuthController extends Controller
{
    // 1. Mostra a tela de Login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // 2. Valida E-mail e Senha e GERA o 2FA
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Checa se usuário existe, se a senha bate e se está ativo
        if (!$user || !Hash::check($request->password, $user->password) || !$user->is_active) {
            return back()->withErrors(['email' => 'Credenciais inválidas ou usuário inativo.']);
        }

        // Gera código de 6 dígitos
        $code = rand(100000, 999999);

        $user->update([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(10), // Expira em 10 min
        ]);

        // Dispara o e-mail
        Mail::to($user->email)->send(new TwoFactorCodeMail($code));

        // Guarda o ID na sessão temporária para o próximo passo
        session(['2fa_user_id' => $user->id]);

        return redirect()->route('admin.2fa');
    }

    // 3. Mostra a tela de inserção do Código 2FA
    public function show2FAForm()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }
        return view('admin.auth.2fa');
    }

    // 4. Valida o Código 2FA e LOGA o usuário de fato
    public function verify2FA(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        $userId = session('2fa_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        // Verifica se o código bate e não expirou
        if ($user->two_factor_code !== $request->code || now()->greaterThan($user->two_factor_expires_at)) {
            return back()->withErrors(['code' => 'Código inválido ou expirado. Tente fazer login novamente.']);
        }

        // Sucesso! Loga o usuário de verdade
        Auth::login($user);

        // Limpa os dados de 2FA por segurança
        $user->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ]);
        session()->forget('2fa_user_id');
        $request->session()->regenerate(); // Evita Session Fixation

        return redirect()->intended('/admin/projetos');
    }

    // 5. Logout Padrão
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
