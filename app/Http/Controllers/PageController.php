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

    public function getPageList() {
        $pages = Page::all();
        return view('page/page-list')->with('pages', $pages);
    }

    public function getCreatePage() {
        return view('page/create-page');
    }

    public function postCreatePage() {
        $inputs = Input::all();
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return Redirect::to('page/create-page')->with('errors', $validator->errors()->all())->withInput();
        } else {
            $page = array("title"=>$inputs['title'],"description"=>$inputs['description']);
            $page_id = Page::insertGetId($page);
            return Redirect::to('page/update-page/'.$page_id)->with('success', 'Page created successfully!!!');
        }
    }

    public function getUpdatePage($id) {
        $page_obj = new Page();

        $page = $page_obj->where('page_id', $id)->first();
        if (is_object($page)) {

            return view('page/create-page')->with('page', $page);
        } else {
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
            return Redirect::to('page/update-page/' . $id)->with('errors', $validator->errors()->all())->withInput();
        } else {
            $page->title = $inputs['title'];
            $page->description = $inputs['description'];
            $page->save();
            return Redirect::to('page/update-page/' . $id)->with('success', 'Page updated successfully!!!');
        }
    }

    public function getDelete($id) {
        Page::destroy($id);
        return Redirect::to('page/page-list')->with('success', trans('messages.page_deleted'));
    }

}
