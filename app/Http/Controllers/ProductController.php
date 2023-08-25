<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.index',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }

    function getSubcategory(Request $request){
        $str = '<option value="">Select Subcategory</option>';
       $subcategories = Subcategory::where('category_id', $request->categoryId)->get();

       foreach($subcategories as $subcategory)
       $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
       echo $str;
    }

    function product_store(ProductRequest $request){
        $after_implode = implode(',', $request->tags);
        $preview_image = $request->preview_image;
        $extension = $preview_image->extension();
        $file_name = str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(1000,1000000). '.' .$extension;
        Image::make($preview_image)->resize(300, 200)->save(public_path('uploads/product/preview-image/'.$file_name));

       $product_id = Product::insertGetId([
            'category_id'=> $request->category,
            'subcategory_id'=> $request->subcategory,
            'brand_id'=> $request->brand,
            'product_name'=> $request->product_name,
            'price'=> $request->price,
            'discount'=> $request->discount,
            'after_discount'=> $request->price-($request->price * $request->discount / 100),
            'tags'=> $after_implode,
            'short_description'=> strip_tags($request->short_description),
            'long_description'=> strip_tags($request->long_description),
            'additional_information'=> strip_tags($request->additional_information),
            'preview_image'=> $file_name,
            'slug'=> str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(10000000,90000000) ,
            'created_at'=>Carbon::now(),

        ]);

        foreach($request->gallery_image as $gallery){
            $extension = $gallery->extension();
            $file_name = str::lower(str_replace(' ', '-', $request->product_name)).'-'.random_int(1000000,90000000). '.' .$extension;
        Image::make($gallery)->resize(300, 200)->save(public_path('uploads/product/gallery-image/'.$file_name));

        ProductGallery::insert([
            'product_id'=>$product_id,
            'gallery'=>$file_name,

        ]);
        }

        return back()->with('success', 'Product added successfully!');

    }

    function product_list(){
        $products = Product::all();
        return view('admin.product.list',[
            'products'=> $products,
        ]);
    }


    function product_delete($id){
        $product = Product::find($id);
        $gallery = ProductGallery::where('product_id', $id)->get();

        $preview_image = public_path('uploads/product/preview-image/'.$product->preview_image);
        unlink($preview_image);

        foreach($gallery as $gal){
            $gal_image = public_path('uploads/product/gallery-image/'.$gal->gallery);
            unlink($gal_image);
            ProductGallery::find($gal->id)->delete();
        }
        Product::find($id)->delete();

        return back()->with('success', 'Product deleted successfully!');

    }


        function product_show($id){
            $product = Product::find($id);
            $galleries = ProductGallery::where('product_id', $id)->get();
            return view('admin.product.show',[
                'product' =>$product,
                'galleries' =>$galleries,
            ]);
        }


}
