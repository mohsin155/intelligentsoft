<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;


class CategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['getLogin', 'postLogin']]);
    }

    public function getCategoryList(){
        $categories = Category::all();
        return view('category/category-list')->with('categories',$categories);
    }
    
    public function getCreateCategory() {
        return view('category/create-category');
    }
    
    public function postCreateCategory(){
        $inputs = Input::all();
        if(!array_filter($inputs['category_title'])){
            $errors[] = trans('Atleast one category is required.');
            return Redirect::to('category/create-category')->withInput()->with('errors',$errors);
        }else{
            $category = array();
            foreach($inputs['category_title'] as $category){
                if($category!='')
                    $category_data[]['category_title'] = $category;
            }
            Category::insert($category_data);
            return Redirect::to('category/category-list')->with('success','Category created successfully.');
        }
    }
    
    public function getDelete($id){
        Category::destroy($id);
        return Redirect::to('category/category-list')->with('success',trans('messages.user_deleted'));
    }
    

}
