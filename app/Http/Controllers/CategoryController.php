<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    function category(){
        $categories = category::Paginate(5);
        // $categories = category::simplePaginate(5);
        return view('admin.category.category', [
            'categories' => $categories,
        ]);

    }

    function category_store(Request $request){
        // print_r($request->all());
        $request->validate([
            'category_name'=> 'required | unique:categories',
            'category_image'=> 'required | image',
            'photo'=> 'file | max:512 | dimensions:min_width=50,min_height=50',
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


    function category_trash(){
        $trash_category = Category::onlyTrashed()->get();

        return view('admin.category.trash',[
            'trash_category' => $trash_category,
        ]);
    }

    function category_restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back();
    }

    function category_hard_delete($category_id){
        $category = Category::onlyTrashed()->find($category_id);
        $image = public_path('uploads/category/'.$category->category_image);
        unlink($image);

        Category::onlyTrashed()->find($category_id)->forceDelete();
        Subcategory::where('category_id', $category_id)->update([
            'category_id'=>16,

        ]);
        return back();

    }


    function delete_checked(Request $request){
        // print_r($request->category_id);
        foreach ($request-> category_id as $category) {
            Category::find($category)->delete();
            Subcategory::where('category_id', $category)->update([
                'category_id'=>16,

            ]);
        }
        return back();

    }


    function restore_checked(Request $request){
        foreach ($request-> category_id as $category) {
            Category::onlyTrashed()->find($category)->restore();
        }
        return back();
    }
}
