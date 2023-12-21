<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected function registered(Request $request, $user)
    {
        $user->roles()->sync(1);
        return redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // Mio
        $mensajes = array(
            'name.required' => 'Campo nombre requerido',
            'name.max' => 'Campo nombre demasiado largo',

            'email.required' => 'Campo email requerido',
            'email.max' => 'Campo email demasiado largo',
            'email.unique' => 'El email ya existe en la base de datos',
            'email.email' => 'El email debe ser un email válido',

            'alias.required' => 'Campo alias requerido',
            'alias.min' => 'Campo alias demasiado corto',
            'alias.max' => 'Campo alias demasiado largo',
            'alias.unique' => 'El alias ya existe en nuestra base de datos',

            'web.max' => 'Campo web demasiado largo',

            'password.required' => 'Campo password requerido',
            'password.confirmed' => 'Los campos password no coinciden',
            'password.regex' => 'La contraseña debe tener un minimo de 8 caracteres y contener al menos una mayuscula, una minuscula y caracter especial.'
        );

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'alias' => ['required', 'string', 'min:3', 'max:20', 'unique:users'],
            'web' => ['max:20'],

            'password' => array('required','string','confirmed','regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/')
        ], $mensajes);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],

            'alias' => $data['alias'],
            'web' => $data['web'],

            'password' => Hash::make($data['password']),
        ]);
    }
}
