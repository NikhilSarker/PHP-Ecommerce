<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        $categories = Category::all();
        $products = Product::where('status', 1)->latest()->get();
        return view('frontend.index',[
            'categories'=>$categories,
            'products'=>$products,
        ]);
    }
    // function about(){
    //     return view('about');
    // }
    // function contact(){
    //     return view('contact');
    // }
}
