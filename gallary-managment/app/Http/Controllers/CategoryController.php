<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add($id=0){
        if($id>0){
            $category=Category::find($id);
            return view('Category.add')->with('category',$category);
        }else{
            return view('Category.add');
        }
    }

    public function list(){
       $categories = Category::all();
       return view('category.list')->with('categories',$categories);
    }

    public function addUpdate(Request $request){
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(isset($data['id']) && $data['id']>0){
            $category = Category::find($data['id']);

        }else{
            $category = new Category;
        }
        $category->category_name = $data['category_name'];
        $category->save();

        return redirect()->route('category-list');
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category-list');
    }   
}
