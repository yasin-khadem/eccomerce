<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait TokenTrait{
    protected $response;

    protected function getToken($request , $email= null , $password = null)
    {
        $req = Request::create(
            '/oauth/token',
            'post',
            [
                'client_id' => config('ecommerce.passport.id'),
                'client_secret' => config('ecommerce.passport.secret'),
                'grant_type' => 'password',
                'username' => $request->email ?? $email,
                'password' => $request->password ?? $password,
            ]
        );
        return $this->response = app()->handle($req);
    }
    public function getRefreshToken(Request $request, $refresh_token = null){
        $req = Request::create(
            '/oauth/token',
            'post',
            [
                // 'client_id' => config('ecommerce.passport.id'),
                // 'client_secret' => config('ecommerce.passport.secret'),
                'grant_type' => 'refresh_token',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'refresh_token'=>$request->refresh_token ?? $refresh_token
            ]
        );
        return $this->response = app()->handle($req);
    }

    protected function getTokenContent()
    {
        return json_decode($this->response->getContent());
    }
   
    

}