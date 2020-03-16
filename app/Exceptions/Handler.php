<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);

        // return $request->expectsJson()
        //     ? $this->apiHandleException($request, $exception)
        //     : $this->webHandleException($request, $exception);
    }

    /**
     *
     *   Ejecuta una comprobacion de errores sobre las respuestas
     *   http web para responder segun sea el tipo de error
     *
     */
    // public function webHandleException($request, $exception)
    // {
    //     if (method_exists($exception, 'render') && $response = $exception->render($request)) {
    //         return Router::toResponse($request, $response);
    //     } elseif ($exception instanceof Responsable) {
    //         return $exception->toResponse($request);
    //     }
    //     $exception = $this->prepareException($exception);
    //     if ($exception instanceof HttpResponseException) {
    //         return $exception->getResponse();
    //     } elseif ($exception instanceof AuthenticationException) {
    //         return $this->unauthenticated($request, $exception);
    //     } elseif ($exception instanceof ValidationException) {
    //         return $this->convertValidationExceptionToResponse($exception, $request);
    //     }
    //     return $this->prepareResponse($request, $exception);
    // }

    /**
     *
     *   Ejecuta una comprobacion de errores sobre las respuestas 
     *   http api para responder segun sea el tipo de error
     *
     */
    // public function apiHandleException($request, Exception $exception)
    // {
    //     if ($exception instanceof ValidationException) {
    //         return $this->convertValidationExceptionToResponse($exception, $request);
    //     } elseif ($exception instanceof ModelNotFoundException) {
    //         $model = strtolower(class_basename($exception->getModel()));
    //         return $this->errorResponse('No existe ninguna instancia de ' . $model . ' con el id especificado', 404);
    //     } elseif ($exception instanceof HttpResponseException) {
    //         return $this->errorResponse('No posee permisos.', 404);
    //     } elseif ($exception instanceof AuthenticationException) {
    //         return $this->unauthenticated($request, $exception);
    //     } elseif ($exception instanceof AuthorizationException) {
    //         return $this->errorResponse('No posee permisos.', 403);
    //     } elseif ($exception instanceof NotFoundHttpException) {
    //         return $this->errorResponse('No se encontro la url especificada.', 403);
    //     } elseif ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse('El método especificado en la petición no es válido.', 405);
    //     } elseif ($exception instanceof HttpException) {
    //         return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
    //     } elseif ($exception instanceof QueryException) {
    //         if (($exception->errorInfo[1]) == 1451) {
    //             return $this->errorResponse('No se puede eliminar el recurso debido a que está relacionado con otro.', 409);
    //         }
    //     } elseif ($exception instanceof TokenMismatchException) {
    //         return redirect()->back()->withInput($request->input());
    //     }
    //     if (config('app.debug')) {
    //         return parent::render($request, $exception);
    //     }
    //     return $this->errorResponse('Falla inseperada. Intente luego', 500);
    // }
}
