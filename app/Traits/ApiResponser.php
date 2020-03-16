<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{

	/**
	 * 	respuesta satisfactoria a la peticion
	 *
	 * 	@return json
	 */
	private function success($data, $code)
	{
		return response()->json($data, $code);
	}

	/**
	 * 	respuesta erronea a la peticion
	 *
	 * 	@return json
	 */
	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	/**
	 * 	retorna una sola instancia a la peticion
	 *
	 * 	@return json
	 */
	protected function showOne(Model $instance, $code = 200)
	{
		return $this->success($instance, $code);
	}

	/**
	 * 	retorna un arreglo de la instancia
	 * 	transformado, filtrado mediante uno(sort_by), multiples atributos get,
	 * 	paginado.
	 *
	 * 	@return json
	 */
	protected function showAll(Collection $collection, $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->success(['data' => $collection], $code);
		}

		// $collection = $this->filterData($collection);
		$collection = $this->sortData($collection);
		$collection = $this->paginate($collection);
		$collection = $this->cacheResponse($collection);
		return $this->success($collection, $code);
	}

	/**
	 * 	respuesta de tipo mensaje a las peticiones
	 *
	 * 	@return json
	 */
	protected function showMessage($message, $code = 200)
	{
		return $this->success($message, $code);
	}

	/**
	 * 	ordenacion de los atributos mediante la variable get 
	 * 	Ej: para modelo user http://homestead.test/api/usuario?sort_by=nombre
	 * 	utilizando los transformadores php fractal para recibir una columna transformada 
	 *
	 * 	@return Collection
	 */
	protected function sortData(Collection $collection)
	{
		if (request()->has('sort_by')) {
			$attribute = request()->sort_by;
			$collection = $collection->sortBy->{$attribute};
		}
		return $collection;
	}

	/**
	 * 	Filtración de los modelos mediante multiples atributos via variables get
	 * 	Ej: para modelo user http://homestead.test/api/usuario?usuario=1&nombre=juan
	 *
	 * 	@return Collection
	 */
	protected function filterData(Collection $collection)
	{
		foreach (request()->query() as $query => $value) {
			if (isset($query, $value) && $query != 'sort_by' && $query != 'per_page' && $query != 'page') {
				$collection = $collection->where($query, $value);
			}
		}
		return $collection;
	}

	/**
	 * 	paginacion de resultados para los modelos, por defecto $perPage = 15
	 * 	minimo 2 y maximo 50
	 * 	Ej: para modelo user http://homestead.test/api/usuario?per_page=50
	 *
	 * 	@return Collection
	 */
	protected function paginate(Collection $collection)
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50'
		];
		Validator::validate(request()->all(), $rules);
		$page = LengthAwarePaginator::resolveCurrentPage();
		$perPage = 15;
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
		}
		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);
		$paginated->appends(request()->all());
		return $paginated;
	}

	/**
	 * 	mantiene un cache en memoria de la peticion, sin guardar el cliente
	 * 	cualquier cliente que realice la peticion esta sujeto al cache
	 * 	el cual tiene una duracion de 5 minutos (300/60)
	 *
	 * 	@return Collection
	 */
	protected function cacheResponse($data)
	{
		$url = request()->url();
		$queryParams = request()->query();
		ksort($queryParams);
		$queryString = http_build_query($queryParams);
		$fullUrl = "{$url}?{$queryString}";
		return Cache::remember($fullUrl, 300 / 60, function () use ($data) {
			return $data;
		});
	}
}
