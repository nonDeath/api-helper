<?php

namespace Spys\ApiHelper;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LaravelApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseBuilder;
}
