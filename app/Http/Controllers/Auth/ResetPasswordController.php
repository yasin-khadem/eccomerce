<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function reset(ResetPasswordRequest $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );
    }
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->setRememberToken(Str::random(60));
        $user->save();
        //why
        // event(new PasswordReset($user));
        //why


        // $this->guard()->login($user);
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message'=> 'Password reset succeeded','response'=>$response],200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset failed', 'response' => $response], 500);
    }

  


}
