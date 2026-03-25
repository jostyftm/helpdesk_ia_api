<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Contracts\Routing\ResponseFactory;
use \Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandlerApiException extends Exception
{

    /**
     *
     */
    private Exception $exception;

    public function __construct(Exception $e) {
        $this->exception = $e;
    }

    /**
     * Render the exception into an HTTP response.
     * 
     * @return array
     */
    public function render()
    {
        $response = $this->handleValidationException($this->exception);
        return $response;
    }

    private function errorResponse(array $data, string $message, int $statusCode)
    {
        return response()->json([
            'errors' => $data,
            'message' => $message,
            'status_code' => $statusCode,
        ], $statusCode);
    }

    /**
     * 
     */
    private function handleValidationException(Exception $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse([], $message = $exception->getMessage(), 401);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse([], $message = 'El metodo es invalido', 405);
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse($exception->errors(), 'Error de validación', 422);
        }

        if($exception instanceof UnauthorizedException) {
            return $this->errorResponse([], $message = $exception->getMessage(), 401);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse([], 'La url especificada', 404);
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse([], $exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse([], 'No hay resultado', 404);
        }

        if (config('app.debug')) {
            dd($exception);
        }

        return $this->errorResponse([], 'Unexpected Exception. Try later', 500);
    }
}
