<?php

namespace App\Http\Controllers\Controller\Province;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->showAll($products);
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
            'capital' => 'required'
        ];
        $this->validate($request, $rules);
        $columns = $request->all();
        $province = Province::create($columns);
        return $this->showOne($province, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::findOrFail($id);
        return $this->showOne($province);
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
            'id' => 'integer|required'
        ];
        $this->validate($request, $rules);
        $province = Province::findOrFail($id);
        if ($request->has('name')) {
            $province->name = $request->name;
        }
        if ($request->has('capital')) {
            $province->capital = $request->name;
        }
        if (!$province->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $province->save();
        return $this->showOne($province);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();
        return $this->showOne($province);
    }
}
