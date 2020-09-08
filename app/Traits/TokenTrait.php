<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait TokenTrait{
    protected $response;

    protected function getContent()
    {
        return json_decode($this->response->getContent());
    }
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
   
    

}