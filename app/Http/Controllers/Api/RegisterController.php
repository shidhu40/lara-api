<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
class RegisterController extends ApiController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserStoreRequest $request)
    {
       
		$validated = $request->validated();
		try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $success['name']  = $user->name;
            $message          = 'Yay! A user has been successfully created.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
			
			return $this->successResponse($success);
        } catch (Exception $e) {
			return $this->errorResponse('Oops! Unable to create a new user.',401);
        }
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {	
		$credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user             = Auth::user();
            $success['name']  = $user->name;
            $success['token'] = $user->createToken('accessToken')->accessToken;

            return $this->successResponse($success, 'You are successfully logged in.');
        } else {
            return $this->errorResponse('Unauthorised',401);
        }
    }
}
