<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = category::all();
        return view('admin.subcategory.subcategory', [
            'categories'=>$categories,
        ]);
    }

    function subcategory_store(Request $request){
        $request->validate([
            'category_name'=>'required',
            'subcategory_name'=>'required',
            'subcategory_image'=>'required | image',

        ]);
        // Subcategory::insert([
        //     'category_id'=>$request->category_name,
        //     'subcategory_name'=>$request->subcategory_name,
        //     'subcategory_image'=>$request->subcategory_image,

        // ]);
        $img = $request->subcategory_image;
        $extension = $img->extension();
        $file_name = str::lower(str_replace(' ', '-', $request->subcategory_name)). '.' .$extension;
        // echo $file_name;
        $image = Image::make($img)->resize(300, 200)->save(public_path('uploads/subcategory/'.$file_name));
        Subcategory::insert([

            'category_id'=>$request->category_name,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_image'=>$file_name,
            'created_at'=>Carbon::now(),

        ]);

        return back()->with('success', 'Subcategory Added Successfully!');
    }

    function subcategory_edit($id){
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.edit', [
            'categories'=>  $categories,
            'subcategory'=>  $subcategory,
        ]);
    }
}
