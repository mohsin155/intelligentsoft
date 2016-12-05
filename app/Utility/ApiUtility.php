<?php

namespace App\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ApiUtility extends Controller {

    
    public $jsonError;
    public $response;
    
    public function __construct() {
        
    }
    
    public function renderJson($status, $response_code, $data, $message = '') {
        $this->response['status'] = $status;
        $this->response['response_code'] = $response_code;
        $this->response['data'] = $data;
        $this->response['message'] = $message;
        return Response()->json($this->response, 200);
    }
    
    public function validateJson() {
        try{
        $request = Request::instance();
        
        json_decode($request->getContent(),true);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = false;
                break;
            case JSON_ERROR_DEPTH:
                $error = true;
                $this->jsonError = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = true;
                $this->jsonError = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = true;
                $this->jsonError = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = true;
                $this->jsonError = 'Syntax error, malformed JSON.';
                break;
            case JSON_ERROR_UTF8:
                $error = true;
                $this->jsonError = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_RECURSION:
                $error = true;
                $this->jsonError = 'One or more recursive references in the value to be encoded.';
                break;
            case JSON_ERROR_INF_OR_NAN:
                $error = true;
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = true;
                $this->jsonError = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = true;
                $this->jsonError = 'Unknown JSON error occured.';
                break;
        }

        return $error;
        }catch(\Exception $e){
            echo $e;exit;
        }
    }

}
