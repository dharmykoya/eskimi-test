<?php

namespace App\Exceptions;

use App\Traits\JsonResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use JsonResponseTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
        ValidationException::class,
        ApplicationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ApplicationException) {
            $code = $e->getCode();
            $message = $e->getMessage();
            return $this->error(null, $message, $code);
        }

        // If Model Not found (e.g: not existing user error)
        if ($e instanceof ModelNotFoundException) {
            $model = ucwords(strtolower(class_basename($e->getModel())));
            return $this->error(
                null,
                "Does not exist any instance of {$model} with the given id",
                Response::HTTP_NOT_FOUND
            );
        }

        if ($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();
            return $this->error($errors, 'The given data was invalid', Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        if (env('APP_DEBUG', false)) {
            return parent::render($request, $e);
        }

        // @phpstan-ignore-next-line
        return $this->fatalError($e);
    }
}
