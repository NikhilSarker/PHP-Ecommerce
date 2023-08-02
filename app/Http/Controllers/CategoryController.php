<?php

namespace App\Http\Controllers;

use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    function category(){
        $categories = category::all();
        return view('admin.category.category', [
            'categories' => $categories,
        ]);

    }

    function category_store(Request $request){
        // print_r($request->all());
        $request->validate([
            'category_name'=> 'required | unique:categories',
            'category_image'=> 'required',
            'category_image'=> 'image',
            'photo'=> 'file | max:512',
            'photo'=> 'dimensions:min_width=50,min_height=50',
        ]);
        $img = $request->category_image;
        $extension = $img->extension();
        $file_name = str::lower(str_replace(' ', '-', $request->category_name)).'-'.random_int(1000,1000000). '.' .$extension;
        // echo $file_name;
        $image = Image::make($img)->resize(300, 200)->save(public_path('uploads/category/'.$file_name));
        category::insert([
            'category_name'=>$request->category_name,
            'category_image'=>$file_name,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('success', 'Category added successfully.');
    }

    function category_edit($category_id){
        $category_info = Category::find($category_id);
        // return $category_info;
        return view('admin.category.edit',[
            'category_info'=> $category_info,
        ]);
    }


    function category_update(Request $request){

        $category = Category::find($request->category_id);
        // print_r($request->all());
        if ($request->category_image == '') {
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'updated_at'=>Carbon::now(),

            ]);
            return redirect()->route('category');

        }else{
            $current_image = public_path('uploads/category/'. $category->category_image);
            unlink($current_image);

            $img = $request->category_image;
            $extension = $img->extension();
            $file_name = str::lower(str_replace(' ', '-', $request->category_name)).'-'.random_int(1000,1000000). '.' .$extension;
            // echo $file_name;
            Image::make($img)->resize(300, 200)->save(public_path('uploads/category/'.$file_name));
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$file_name,
                'updated_at'=>Carbon::now(),

            ]);
            return redirect()->route('category');
        }
    }


    function category_soft_delete($category_id){
        Category::find($category_id)->delete();
        return back();

    }
}
