<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'phone' => 'required|string|max:255',
			'birthday' => 'required|date',
			'department' => 'required|string|alpha_num|max:255',
			'title' => 'required|string|alpha_num|max:255',
			'account' => array(
							'required',
							'string',
							'max:255',
							'min:8',
							'max:16',
							'unique:users',
							'regex:/^[a-zA-Z][a-zA-Z0-9_]{8,16}$/',
							),
            'nickname' => 'required|alpha_num|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => array(
							'required',
							'string',
							'min:8',
							'max:16',
							'confirmed',
							'regex:/^(?!.*[^a-zA-Z0-9])(?=.*\d)(?=.*[a-zA-Z]).{8,16}$/',
							),
        ]);
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
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'phone' => $data['phone'],
			'birthday' => $data['birthday'],
			'department' => $data['department'],
			'title' => $data['title'],
			'account' => $data['account'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
