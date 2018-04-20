<?php namespace Spys\ApiHelper;

use Exception;
use Illuminate\Session\TokenMismatchException;
use Styde\Html\Facades\Alert;

trait ExceptionHandlerJsonTrait
{
    use ResponseBuilder;

    public function captureRender($request, Exception $exception, $cb)
    {
        if ($request->is(config('api.prefix', 'api').'/*')) {
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return $this->failure(
                    __($exception->getMessage()),
                    null,
                    $exception->getStatusCode()
                );
            }

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->failure($exception->getMessage(), null, 401);
            }

            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $this->errorNotFound();
            }

            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return $this->failure(trans('messages.authorization-exception'), null, 403);
            }
            // place other handlers here
        }

        return $cb($request, $exception);
    }
}
