<?php

namespace App\Http\Middleware;

use Closure;
use App\Utility\ApiUtility;

class ValidateJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
        $api_util = new ApiUtility;
        $result =$api_util->validateJson();
        //$result = true;
        if($result){
            return $api_util->renderJson(config('constants.status.error'), config('constants.status_code.invalid_json'), FALSE, $api_util->jsonError);
        }
        return $next($request);
        }  catch (\Exception $e){
            echo $e;exit;
        }
    }
}
