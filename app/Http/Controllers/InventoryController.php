<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Size;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function variation(){
        $colors = Color::all();
        $categories = Category::all();

        return view('admin.product.variation',[
            'colors'=>$colors,
            'categories'=>$categories,

        ]);
    }

    function color_store(Request $request){
        $request->validate([
            'color_name'=>'required',
            // 'color_code'=>'required',
        ]);

        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('color', 'Color added successfully!');

    }

    function size_store(Request $request){
        $request->validate([
            'size_name'=>'required',
            'category_id'=>'required',
        ]);

        Size::insert([
            'category_id'=>$request->category_id,
            'size_name'=>$request->size_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('size', 'Size added successfully!');

    }


        function color_remove($id){
            Color::find($id)->delete();
            return back()->with('color_remove', 'Color Deleted successfully!');

        }
        function size_remove($id){
            Size::find($id)->delete();
            return back()->with('size_remove', 'Size Deleted successfully!');

        }

        function inventory($id){
            $product = Product::find($id);
            $colors = Color::all();
            return view('admin.product.inventory',[
                'product'=>$product,
                'colors'=>$colors,
            ]);
        }

        function inventory_store(Request $request, $id){
            Inventory::insert([
                'product_id'=>$id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('inventory_added', 'Inventory Added successfully!');
        }
}
