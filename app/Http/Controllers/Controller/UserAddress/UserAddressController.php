<?php

namespace App\Http\Controllers\Controller\UserAddress;

use App\Http\Controllers\ApiController;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAddresses = UserAddress::all();
        return $this->showAll($userAddresses);
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
            'user_id' => 'required|integer',
            'commmune_id' => 'required|integer',
            'address' => 'required'
        ];
        $this->validate($request, $rules);
        $columns = $request->all();
        $userAddress = UserAddress::create($columns);
        return $this->showOne($userAddress);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userAddress = UserAddress::findOrFail($id);
        return $this->showOne($userAddress);
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
            'id' => 'required|integer'
        ];
        $this->validate($request, $rules);
        $userAddress = UserAddress::findOrFail($id);
        if ($request->has('address')) {
            $userAddress->address = $request->address;
        }
        if (!$userAddress->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $userAddress->save();
        return $this->showOne($userAddress);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userAddress = UserAddress::findOrFail($id);
        $userAddress->delete();
        return $this->showOne($userAddress);
    }
}
