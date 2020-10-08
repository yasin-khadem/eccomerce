<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\TokenTrait;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use TokenTrait;
    public function register(RegisterRequest $request){
        
        $user = $this->createUser($request);

        $response = $this->getToken($request);

        if ($response->status() !== 200) {
            return $response;
        }

        return new UserResource($user, $this->getTokenContent());
    }
    protected function createUser($request)
    {
        return User::create($request->only('name','email','password'));
        

    }
}
