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

        if(Subcategory::where('category_id', $request->category_name)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('exists', 'Subcategory Already Exists in this Category!');
        }else{
            $img = $request->subcategory_image;
            $extension = $img->extension();
            $file_name = str::lower(str_replace(' ', '-', $request->subcategory_name)). '-'. $request->category_name.'.' .$extension;
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




        // Subcategory::insert([
        //     'category_id'=>$request->category_name,
        //     'subcategory_name'=>$request->subcategory_name,
        //     'subcategory_image'=>$request->subcategory_image,

        // ]);

    }

    function subcategory_edit($id){
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.edit', [
            'categories'=>  $categories,
            'subcategory'=>  $subcategory,
        ]);
    }

    function subcategory_update(Request $request, $id){
        if(Subcategory::where('category_id', $request->category_name)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('exists', 'Subcategory Already Exists in this Category!');
        }else{
            $subcategory = Subcategory::find($id);
            // print_r($request->all());
            if ($request->subcategory_image == '') {
                $subcategory = Subcategory::find($id)->update([
                    'category_id'=>$request->category_name,
                    'subcategory_name'=>$request->subcategory_name,
                    'updated_at'=>Carbon::now(),

                ]);
                return back()->with('update', 'Updated Successfully!');
                // return redirect()->route('subcategory');

            }else{
                $current_image = public_path('uploads/subcategory/'. $subcategory->subcategory_image);
                unlink($current_image);

                $img = $request->subcategory_image;
                $extension = $img->extension();
                $file_name = str::lower(str_replace(' ', '-', $request->subcategory_name)).'-'. $request->category_name. '.' .$extension;
                // echo $file_name;
                Image::make($img)->resize(300, 200)->save(public_path('uploads/subcategory/'.$file_name));
                $subcategory = Subcategory::find($id)->update([
                    'category_id'=>$request->category_name,
                    'subcategory_name'=>$request->subcategory_name,
                    'subcategory_image'=>$file_name,
                    'updated_at'=>Carbon::now(),

                ]);
                return back()->with('update', 'Updated Successfully!');

            }
        }
    }


    function subcategory_delete($id){
        $Subcategory = Subcategory::find($id);

        $image = public_path('uploads/subcategory/'.$Subcategory->subcategory_image);
        unlink($image);

        Subcategory::find($id)->delete();
        return back()->with('deleted', 'Subcategory Deleted Successfully!');
    }
}
