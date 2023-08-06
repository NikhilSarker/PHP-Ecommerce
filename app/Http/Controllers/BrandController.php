<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('admin.Brand.brand',[
            'brands'=> $brands,

        ]);
    }

    function brand_store(Request $request){
        $request->validate([
            'brand_name'=> 'required',
            'brand_logo'=> 'required | image',

        ]);

        $logo = $request->brand_logo;
        $extension = $logo->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->brand_name)).'.'.$extension;
        Image::make($logo)->save(public_path('uploads/brand/'.$file_name));

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_logo'=>$file_name,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('brand', 'New Brand Added Successfully!');

    }

    function brand_edit($id){
        $brand = Brand::find($id);
        // return $category_info;
        return view('admin.Brand.edit',[
            'brand'=> $brand,
        ]);
    }

    function brand_update(Request $request){
        $brand = Brand::find($request->brand_id);
        // print_r($request->all());
        if ($request->brand_logo == '') {
            Brand::find($request->brand_id)->update([
                'brand_name'=>$request->brand_name,
                'updated_at'=>Carbon::now(),

            ]);
            return redirect()->route('brand');

        }else{
            $current_image = public_path('uploads/brand/'. $brand->brand_logo);
            unlink($current_image);

            $img = $request->brand_logo;
            $extension = $img->extension();
            $file_name = str::lower(str_replace(' ', '-', $request->brand_name)).'-'.random_int(1000,1000000). '.' .$extension;
            // echo $file_name;
            Image::make($img)->resize(300, 200)->save(public_path('uploads/brand/'.$file_name));
            Brand::find($request->brand_id)->update([
                'brand_name'=>$request->brand_name,
                'brand_logo'=>$file_name,
                'updated_at'=>Carbon::now(),

            ]);
            return redirect()->route('brand');
        }
    }

    function brand_delete($id){
        $brand = Brand::find($id);

        $image = public_path('uploads/brand/'.$brand->brand_logo);
        unlink($image);

        Brand::find($id)->delete();
        return back()->with('deleted', 'Brand Deleted Successfully!');
    }
}
