<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function cerbairLogin(Request $request) {
        $req = $request->validate([
            'code' => ['required'],
            'state' => ['required']
        ]);

        $token_response = Http::post(config('auth.oauth2.token_url'), [
            'grant_type' => 'authorization_code',
            'client_id' => config('auth.oauth2.id'),
            'client_secret' => config('auth.oauth2.secret'),
            'code' => $req['code']
        ]);

        if ($token_response->failed()) {
            abort(401);
        }

        $token = $token_response['access_token'];

        $user_response = Http::withToken($token)->get(config('auth.oauth2.user_endpoint_url'));

        if ($user_response->failed()) {
            abort(401);
        }

        $prenom = $user_response['first_name'];
        $nom = $user_response['last_name'];
        $email = $user_response['email'];
        if(User::where('email', $email)->exists()) {
            $user = User::where('email', $email)->first();
        } else {

            $user = new User();
            $user->email = $email;
            $user->pseudo = ucfirst($prenom) . ' ' . strtoupper($nom);
            $user->email_verified_at = Carbon::now();
            $user->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended();


    }

    public function loginView()
    {
        return view('auth.login', [
            'cerbairLink' => config('auth.oauth2.authorize_url')
                . '?response_type=code'
                . '&client_id='  . config('auth.oauth2.id')
                . '&redirect_uri='. config('auth.oauth2.redirect_uri')
                . '&scope=profile email'
                . '&state=' . hash('sha1', session_id())
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['boolean']
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'enabled' => true
        ], $credentials['remember'])) {

            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Ces identifiants sont incorrects.'
        ])->onlyInput('email');
    }

    public function disconnect(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'pseudo' => ['required', 'string', 'alpha_num', 'unique:App\Models\User,pseudo'],
        ]);

        $user = new User();
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->pseudo = $credentials['pseudo'];
        $user->save();

        event(new Registered($user));

        return redirect('/');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/');
    }

    public function resendEmailVerification(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function sendPasswordReset(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm(Request $request, string $token) {
        $param = $request->validate([
            'email' => 'required|email'
        ]);
        return view('auth.reset-password', ['token' => $token, 'email' => $param['email']]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
