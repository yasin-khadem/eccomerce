<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Traits\TokenTrait;

class LoginController extends Controller
{
    use TokenTrait;

    public function login(LoginRequest $request){

        $user = $this->getUser($request);
       
        
        $response= $this->getToken($request);


        if($response->status() !== 200){
            return $response;
        }
        

        return new UserResource($user, $this->getContent()); 

    }
    protected function getUser($request){
        $user = User::whereEmail($request->email)->first();
        if (!Hash::check($request->password, optional($user)->password)) {
            throw ValidationException::withMessages([
                'email' => 'اطلاعات شما درست نیست'
            ]);
        }
        return $user;
    }
  
}
