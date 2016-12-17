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
        $this->jsonData = json_decode($request->getContent(), true);
    }

    public function getTester() {
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
                $data = "";
                $status = config('constants.status.error');
                $status_code = config('constants.status_code.ok');
                $message = $validator->messages()->first();
            } else {
                $user_data = array('user_name' => $inputs['username'], 'email' => $inputs['email'], 'user_type' => $inputs['user_type'],
                    'password' => Utility::generatePassword($inputs['password']));
                $status = $inputs['user_type'] == 2 ? 1 : 0;
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
        return $this->renderJson($status, $status_code, $data, $message);
    }

    public function postProfileUpdate() {
        try {
            $inputs = $this->jsonData;
            $user = User::find($inputs['user_id']);
            if (!empty($user)) {
                $user_data = array(
                    'first_name' => $inputs['first_name'],
                    'last_name' => $inputs['last_name'],
                    'address' => $inputs['address'],
                    'latitude' => $inputs['latitude'],
                    'longitude' => $inputs['longitude'],
                    'mobile_number' => $inputs['mobile_number']
                );
                if (!empty($inputs['password'])) {
                    $user_data['password'] = Utility::generatePassword($inputs['password']);
                }
                User::where('user_id', '=', $user->user_id)->update($user_data);
                $user = User::find($user->user_id);
                $data = $user;
                $status = config('constants.status.success');
                $status_code = config('constants.status_code.ok');
                $message = trans('messages.user_signup');
            } else {
                $data = "";
                $status = config('constants.status.error');
                $status_code = config('constants.status_code.ok');
                $message = "User does not exist";
            }
        } catch (Exception $ex) {
            echo $e;
            exit;
        }
        return $this->renderJson($status, $status_code, $data, $message);
    }

    public function postUpdateProvider() {
        try {
            $inputs = $this->jsonData;
            $rules = array('category' => 'required', 'user_id' => 'required|exists:users,user_id', 'description' => 'required');
            $validator = Validator::make($inputs, $rules);
            if ($validator->fails()) {
                $data = "";
                $status = config('constants.status.error');
                $status_code = config('constants.status_code.ok');
                $message = $validator->messages()->first();
            } else {
                $provider = User::find($inputs['user_id']);
                $provider->category = $inputs['category'];
                $provider->description = $inputs['description'];
                $provider->save();
                $data = $provider;
                $status = config('constants.status.success');
                $status_code = config('constants.status_code.ok');
                $message = trans('messages.user_signup');
            }
        } catch (Exception $ex) {
            echo $e;
            exit;
        }
    }

    public function getPageList() {
        try {


            $data = \App\Models\Page::all();
            $status = config('constants.status.success');
            $status_code = config('constants.status_code.ok');
            $message = trans('messages.pagelist');
        } catch (Exception $ex) {
            echo $e;
            exit;
        }
        return $this->renderJson($status, $status_code, $data, $message);
    }

}
