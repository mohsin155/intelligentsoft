<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utility\Utility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Departments;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['getLogin', 'postLogin']]);
    }

    public function getDashboard() {
        $clients = User::where('user_type','=',2)->count();
        $provider = User::where('user_type','=',3)->count();
        return view('dashboard')->with('clients',$clients)->with('provider',$provider);
    }

    public function getUserList(){
        $users = User::where('user_type','=',2)->get();
        return view('user-list')->with('users',$users);
    }
    
    public function getCreateUser() {
        return view('create-user');
    }
    
    public function getChangePassword(){
        return view('change-password');
    }
    
    public function getUpdateUser(Request $request,$id) {
        $user_obj = new User();
        //dd($user);exit;
        $user = $user_obj->getUserDetail($id);
        //dd($user->first_name);
        if(is_object($user)){
            return view('create-user')->with('user',$user);
        }else{
            return Redirect::to('users/create-user');
        }
        
    }
    public function getLogin() {
        if (Auth::check()) {
            return Redirect::to('users/dashboard');
        } else {
            return view('login');
        }
    }

    public function postLogin() {
        $inputs = Input::all();
        $rules = array(
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:12'
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            //dd($validator->errors()->all());exit;
            return Redirect::to('users/login')->with('errors', $validator->errors()->all())->withInput();
        } else {
            if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password'], 'status' => '1'], false)) {
                return Redirect::to('users/dashboard');
            } else {
                $message[] = trans('messages.login_fail');
                return Redirect::to('users/login')->with('errors', $message);
            }
        }
    }

    public function postCreateUser() {
        $user = new User();
        $inputs = Input::all();
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:12'
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            //dd($validator->errors()->all());exit;
            return Redirect::to('users/create-user')->with('errors', $validator->errors()->all())->withInput();
        } else {
            $user->processUser($inputs);
            return Redirect::to('users/create-user')->with('success', 'User created successfully!!!');
        }
    }

    public function postUpdateUser($id) {
        $user = User::find($id);
        $inputs = Input::all();
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            //dd($validator->errors()->all());exit;
            return Redirect::to('users/update-user/'.$id)->with('errors', $validator->errors()->all())->withInput();
        } else {
            $email_ver = User::select('user_id')->where('email', '=', $inputs['email'])->where('user_id', '<>', $id)->first();
            if(is_object($email_ver)){
                $errors[] = 'Email already exist'; 
                return Redirect::to('users/update-user/'.$id)->with('errors',$errors)->withInput();
//            }elseif(!Hash::check($inputs['old_password'], $user->password)){
//                $errors[] = 'Old Password is incorrect'; 
//                return Redirect::to('users/update-user/'.$id)->with('errors',$errors)->withInput();
//            }else{
            }else{
                $user->processUser($inputs,$id);
                return Redirect::to('users/update-user/'.$id)->with('success', 'User updated successfully!!!');
            }
        }
    }
    
    /**
     * Change password view
     * @return type
     */
    public function postChangePassword($id) {
        $user = new User();
        $inputs =  Input::all();
        $rules = array(
            'old_password' => 'required',
            'password' => array('required','confirmed','min:6','regex:/^[^\s]+$/')
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
             return Redirect::to('users/change-password/'.$id)->with('errors', $validator->errors()->all())->withInput();
        } else {
            $auth_user = Auth::User();
            if (!Hash::check($inputs['old_password'], $auth_user->password)) {
                $message[] = trans('messages.password_not_match');
                $status = 'errors';
            } else {
                $user->updatePassword($auth_user->user_id, $inputs['password']);
                $message = trans('messages.password_changed');
                $status = 'success';
            }
        }
        return Redirect::to('users/change-password')->with($status, $message);
    }
    /**
     * Logout from admin
     * @return type redirect to admin login
     */
    public function getLogout() {
        Auth::logout();
        Session::flush();
        return Redirect::to('users/login');
    }
    
    
    public function getDelete($id){
        User::destroy($id);
        return Redirect::to('users/user-list')->with('success',trans('messages.user_deleted'));
    }
    

}
