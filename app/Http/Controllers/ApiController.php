<?php

namespace App\Http\Controllers;

use App\Utility\ApiUtility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Utility\Utility;


class ApiController extends ApiUtility {

    public $jsonData;
    public function __construct() {
        $this->middleware('App\Http\Middleware\ValidateJson');
        parent::__construct();
        $request = Request::instance();
        $this->jsonData = json_decode($request->getContent(),true);
    }

    public function postTester() {
        try {
            return $this->renderJson(config('constants.status.success'), config('constants.status_code.ok'), FALSE, 'working');
        } catch (\Exception $e) {
            echo $e;
            exit;
        }
    }

    public function postSignup() {
        try {
            $inputs = $this->jsonData;
            $rules = array(
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:12',
                'user_type' => 'required',
            );
            $validator = Validator::make($inputs, $rules);
            if ($validator->fails()) {
                $data = false;
                $status = config('constants.status.error');
                $status_code = config('constants.status_code.ok');
                $message = $validator->messages()->first();
            }else{
                $user_data = array('user_name'=>$inputs['username'],'email'=>$inputs['email'],'user_type'=>$inputs['user_type'],
                        'password'=>Utility::generatePassword($inputs['password']));
                $status = $inputs['user_type']==2?1:0;
                $user_data['status'] = $status;
                $user_id = User::insertGetId($user_data);
                $data = User::find($user_id);
                $status = config('constants.status.success');
                $status_code = config('constants.status_code.ok');
                $message = trans('messages.user_signup');
            }
        } catch (Exception $ex) {
            echo $e;
            exit;
        }
        return $this->renderJson(config('constants.status.success'), config('constants.status_code.ok'), $data, $message);
    }

}
