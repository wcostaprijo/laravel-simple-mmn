<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Indication;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\NetworkService;
use App\Rules\Cpf;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($referencia = null): View|RedirectResponse
    {
        /**
         * Verificando se a referencia informada existe
         * Caso não exista o usuario retornará ao cadastro sem referência
         */
        if(!empty($referencia) and !User::whereUsername($referencia)->first()) {
            return redirect('/register');
        }

        return view('auth.register', ['referencia' => $referencia]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'cpf' => ['required', 'string', 'max:255', 'unique:'.User::class, new Cpf],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'cpf' => str_replace([' ','-','.'], '', $request->cpf),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /**
         * Cadastrando a rede
         */
        if($request->has('referencia') and !empty($request->referencia)) {
            $userUp = User::whereUsername($request->referencia)->firstOrFail();
            NetworkService::register($user, $userUp, 1);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
