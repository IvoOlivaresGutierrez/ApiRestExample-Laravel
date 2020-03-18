<?php

namespace App\Http\Controllers\Controller\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required'
        ];
        $this->validate($request, $rules);
        $columns = $request->all();
        $user = User::create($columns);
        return $this->showOne($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = $request->password;
        }
        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $user->save();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }

    /**
     * Display the specified cross resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function products($id)
    {
        $user = User::findOrFail($id);
        return $this->showAll($user);
    }

    /**
     * Display the specified cross resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userAddresses($id)
    {
        $userAddresses = User::findOrFail($id)->userAddresses;
        return $this->showAll($userAddresses);
    }
}
