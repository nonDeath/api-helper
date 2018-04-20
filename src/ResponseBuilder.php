<?php namespace Spys\ApiHelper;

use Symfony\Component\HttpKernel\Exception\HttpException;
use League\Fractal\TransformerAbstract;

trait ResponseBuilder
{
    /**
     * Respond with api response
     * @param  mixed                               $value
     * @param  \League\Fractal\TransformerAbstract $transformer
     * @param  callable                            $cb           callback to set aditional response options
     * @param  array                               $includes     optional includes to be parsed
     * @return  \Illuminate\Http\JsonResponse
     */
    public function respond($value, TransformerAbstract $transformer, $cb = null, $includes = [])
    {
        $fractal = fractal($value, $transformer);
        if (! empty($includes)) {
            $fractal = $fractal->parseIncludes($includes);
        }

        return $fractal->respond($cb);
    }

    /**
     * Fractalize success messages
     * @param  string  $element
     * @param  string  $action
     * @param  integer $statusCode
     * @return  \Illuminate\Http\JsonResponse
     */
    public function fractalizeMessage($element, $action, $statusCode = 200)
    {
        return fractal(
            (new ResponseMessage())->make($element, $action, $statusCode),
            new ResponseMessageTransformer
        )->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
    }

    /**
     * Success response with standard message
     * @param  string $element
     * @param  string $action
     * @return  \Illuminate\Http\JsonResponse
     */
    public function success($element, $action = '')
    {
        return $this->fractalizeMessage($element, $action)->respond();
    }

    /**
     * Failure response with standard message
     * @param  string $element
     * @param  string $action
     * @param  integer $statusCode
     * @return  \Illuminate\Http\JsonResponse
     */
    public function failure($element, $action = '', $statusCode = 500)
    {
        return $this->fractalizeMessage($element, $action, $statusCode)->respond($statusCode);
    }

    /**
     * Created response with standard message and created status code
     * @param  string $element
     * @param  string $action
     * @return  \Illuminate\Http\JsonResponse
     */
    public function created($element, $action = 'creación')
    {
        return $this->fractalizeMessage($element, $action, 201)->respond(201);
    }


    /**
     * Accepted response with standard message and accepted status code
     * @param  string $element
     * @param  string $action
     * @return  \Illuminate\Http\JsonResponse
     */
    public function accepted($element, $action = 'procesamiento aceptado')
    {
        return $this->fractalizeMessage($element, $action, 202)->respond(202);
    }

    public function noContent()
    {
        return response(null, 204);
    }

    /**
     * @param  string $message
     * @param  string $statusCode
     */
    public function error($message, $statusCode)
    {
        throw new HttpException($statusCode, $message);
    }

    /**
     * @param string $message
     */
    public function errorNotFound($message = 'Not Found')
    {
        $this->error($message, 404);
    }

    /**
     * @param string $message
     */
    public function errorBadRequest($message = 'Bad Request')
    {
        $this->error($message, 400);
    }

    /**
     * @param string $message
     */
    public function errorForbidden($message = 'Forbidden')
    {
        $this->error($message, 403);
    }

    /**
     * @param string $message
     */
    public function errorInternal($message = 'Internal Error')
    {
        $this->error($message, 500);
    }

    /**
     * @param string $message
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        $this->error($message, 401);
    }

    /**
     * @param string $message
     */
    public function errorMethodNotAllowed($message = 'Method Not Allowed')
    {
        $this->error($message, 405);
    }
}
