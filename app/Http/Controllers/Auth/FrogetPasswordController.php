<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;


class FrogetPasswordController extends Controller
{
    use SendsPasswordResetEmails;


    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
   
    public function broker()
    {
        return Password::broker();
    }

   
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(
            ['message'=>'Email sent',
            'response' => $response],200);
        // return $request->wantsJson()
        //     ? new JsonResponse(['message' => trans($response)], 200)
        //     : back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed to send mail', 
                                 'response' => $response], 500); 
    }

}
