<?php

namespace App\Http\Controllers\Controller\Commune;

use App\Http\Controllers\ApiController;
use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = Commune::all();
        return $this->showAll($communes);
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
            'province_id' => 'required|integer',
            'name' => 'required'
        ];
        $this->validate($request, $rules);
        $columns = $request->all();
        $commune = Commune::create($columns);
        return $this->showOne($commune, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commune = Commune::findOrFail($id);
        return $this->showOne($commune);
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
            'province_id' => 'required|integer'
        ];
        $this->validate($request, $rules);
        $commune = Commune::findOrFail($id);
        if ($request->has('name')) {
            $commune->name = $request->name;
        }
        if (!$commune->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $commune->save();
        return $this->showOne($commune);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commune = Commune::findOrFail($id);
        $commune->delete();
        return $this->showOne($commune);
    }
}
