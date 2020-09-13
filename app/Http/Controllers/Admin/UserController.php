<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(UserRequest $request)
    {
        User::create($request->validated());   
        return response('ok',200);
    }

    
    public function show(User $user)
    {
        return $user;
    }


    
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        if(is_null($data['password'])){
            unset($data['password']);
        }
        $user->update($data);
        return response(['ok'],200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
