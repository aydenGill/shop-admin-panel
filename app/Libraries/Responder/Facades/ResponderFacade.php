<?php

namespace App\Libraries\Responder\Facades;

use App\Libraries\Responder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse respond()
 * @method static JsonResponse respondError()
 * @method static JsonResponse respondNotFound()
 * @method static JsonResponse respondDelete()
 * @method static JsonResponse respondUpdate()
 * @method static JsonResponse respondStore()
 * @method static ResponseBuilder setMessage(string $message)
 * @method static ResponseBuilder setData($data)
 * @method static ResponseBuilder setStatus(int $status)
 * @method static ResponseBuilder setStatusCode(int $status_code)
 */
class ResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ResponseBuilder::class;
    }
}
