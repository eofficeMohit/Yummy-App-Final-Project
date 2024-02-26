<?php

namespace App\Exceptions;

// Add this line at the top of the class
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //start old//
        $this->reportable(function (Throwable $e) {
            //
        });
        //end old//
        $this->renderable(function (Throwable $e) {});
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        //dd($request);
        //  !$request->getSession()->getId()
        // comment this line and return JSON Response.
        //  return parent::render($request, $e->getMessage());
        //return json_encode(['message' => $e->getMessage()], 404); // or you can

        if ($e instanceof AccessDeniedHttpException) {
            return response(view('errors.404'), 404);
        }
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                // not found
                case 404:
                    return response(view('errors.404'), 404);
                    break;

                // internal error
                case '500':
                    return response(view('errors.500'), 500);
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            if (!$request->getSession()->getId()) {
                return json_encode(['message' => 'Un-authorized access, you need to login or add bearer token to header.']);
            }
            if ($e->getCode() === 0) {
                return json_encode(['message' => 'Un-authorized access, you need to login or add bearer token to header.']);
            }
            return parent::render($request, $e); // or you can
        }
    }
}
