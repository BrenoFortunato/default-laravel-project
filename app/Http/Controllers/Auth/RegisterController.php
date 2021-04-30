<?php

namespace App\Http\Controllers\Auth;

use DB;
use Lang;
use Flash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * 
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::$registrationRules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * 
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                "name"              => $data["name"],
                "email"             => $data["email"],
                "password"          => $data["password"],
                "is_active"         => true,
                "photo"             => null,
                "email_verified_at" => null,
            ]);

            // Assign role
            $user->assignRole(config("enums.roles.COMMON.name"));
        } catch (\Throwable $e) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $this->validator($input)->validate();
    
        $user = $this->create($input);
        if (!$user) {
            Flash::error(Lang::get("flash.registration_unexpected_error"));
            return redirect()->back()->withInput($input);
        }

        event(new Registered($user));
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()? new JsonResponse([], 201) : redirect($this->redirectPath());
    }
}
