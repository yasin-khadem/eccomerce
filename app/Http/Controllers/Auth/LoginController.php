<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Traits\TokenTrait;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use TokenTrait;

    public function login(LoginRequest $request)
    {

        $user = $this->getUser($request);


        $response = $this->getToken($request);


        if ($response->status() !== 200) {
            return $response;
        }


        return new UserResource($user, $this->getTokenContent());
    }

    public function refreshToken(Request $request)
    {
        $response = $this->getRefreshToken($request);
        if ($response->status() !== 200) {
            return $response;
        }
        return response(['data' => $this->getTokenContent()], 200);
    }

    protected function getUser($request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!Hash::check($request->password, optional($user)->password)) {
            throw ValidationException::withMessages([
                'email' => 'اطلاعات شما درست نیست'
            ]);
        }
        return $user;
    }
}
