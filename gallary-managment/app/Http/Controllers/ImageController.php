<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function list(){
        
        $images = Image::with('category');
        
        $images=$images->simplePaginate(2);
        $categories = Category::all();

        return view('Image.list')->with('images',$images)->with('categories',$categories);
    }
    // public function imageGet(Request $request){
    //     $data = $request->all();
    //     $images = Image::with('category');
    //     if(isset($data['category']) && $data['category']>0){
    //         $images->where('category_id',$data['category']);
    //     }
    //     if(isset($data['startDate']) && $data['startDate']!=0){
    //         $images->whereDate('created_at','>=',$data['startDate']);

    //     }
    //     if(isset($data['endDate']) && $data['endDate']!=0){
    //         $images->whereDate('created_at','<=',$data['endDate']);

    //     }
    //     $images = $images->simplePaginate(2);
    //     $categories = Category::all();

    //     return view('Image.list')->with('images',$images)->with('categories',$categories);
    // }

    public function add(){
        $categories = Category::all();
        return view('Image.add')->with('categories',$categories);
    }

    public function addUpdate(Request $request){
        $data = $request->all();
       
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,png',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->file('image')){
           
            $image_name = $request->file('image')->getClientOriginalExtension();
            $image_path = time() . $image_name;
            $request->image->storeAs('image', $image_path, 'public');

        }
        if(isset($data['id']) && $data['id']>0){
            $image = Image::find($data['id']);
        }else{
            $image = new Image;
        }
        $image->image_name = $image_name;
        $image->image_path = "/storage/image/".$image_path;
        $image->category_id = $data['category_id'];
        $image->save();

        return redirect()->route('image-list');
    }
    public function delete($id){
        $category = Image::find($id);
        $category->delete();

        return redirect()->route('image-list');
    }  

}
