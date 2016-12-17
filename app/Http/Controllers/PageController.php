<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Page;


class PageController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['getLogin', 'postLogin']]);
    }

    public function getPageList(){
        $pages = Page::all();
        return view('page/page-list')->with('pages',$pages);
    }
    
    public function getCreatePage() {
        return view('page/create-page');
    }
    
     public function postCreatePage() {
        $page = new Page();
        $inputs = Input::all();
        $rules = array(
            'title' => 'required',
            'description' => 'required',
             );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            //dd($validator->errors()->all());exit;
            return Redirect::to('page/create-page')->with('errors', $validator->errors()->all())->withInput();
        } else {
            $page->processUser($inputs);
            return Redirect::to('page/create-page')->with('success', 'Page created successfully!!!');
        }
    }
    
    public function getUpdatePage(Request $request,$id) {
        $page_obj = new Page();
        
        $page = $page_obj->where('page_id', $id)->first();
;
      //  echo $page;
        if(is_object($page)){
        
            return view('page/create-page')->with('page',$page);
        }else{
            return Redirect::to('page/create-page');
        }
        
    }
    
    public function postUpdatePage($id) {
        $page = Page::find($id);
        $inputs = Input::all();
        $rules = array(
            'title' => 'required',
            'description' => 'required',
             );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            //dd($validator->errors()->all());exit;
            return Redirect::to('page/update-page/'.$id)->with('errors', $validator->errors()->all())->withInput();
        }
        else{
                $user->processUser($inputs,$id);
                return Redirect::to('page/update-page/'.$id)->with('success', 'Page updated successfully!!!');
            }
        }
    
    
    
    public function getDelete($id){
        Page::destroy($id);
        return Redirect::to('page/page-list')->with('success',trans('messages.page_deleted'));
    }
    
   public function getLogout() {
        Auth::logout();
        Session::flush();
        return Redirect::to('users/login');
    } 
    public function postChangePassword($id) {
        $user = new User();
        $inputs =  Input::all();
        $rules = array(
            'old_password' => 'required',
            'password' => array('required','confirmed','min:6','regex:/^[^\s]+$/')
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
             return Redirect::to('provider/change-password/'.$id)->with('errors', $validator->errors()->all())->withInput();
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

}
