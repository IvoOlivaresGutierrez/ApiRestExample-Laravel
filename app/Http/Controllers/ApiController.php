<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;

class ApiController extends Controller
{
    /**
     *
     *	Respuestas generalizadas para api 
     *	Cuenta con manejo de errores para respuestas http api,
     *	puede gestionar collection mediante showAll(Collection $collection, $code = 200), el 
     *	codigo de http puede ser modificado aqui,
     *	tambien gestiona respuestas de modelo mediante showOne(Model $instance, $code = 200),
     *	tambien retorna respuestas personalizadas mediante showMessage($message, $code = 200),
     *
     */
    use ApiResponser;
}
