@extends('layouts.admin')

@section('content')
<div class="col-lg-8"></div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Inventory</h3>
        </div>
        <div class="card-body">
            @if (session('inventory_added'))
            <div class="alert alert-success">{{session('inventory_added')}}</div>

            @endif

            <form action="{{route('inventory.store',$product->id)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="product" class="form-label">Product</label>
                    <input disabled type="text" name="product" value="{{$product->product_name}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Color</label>
                    <select name="color_id"  class="form-control">
                        <option value="">Select Color</option>
                        @foreach ($colors as $color )
                        <option value="{{$color->id}}">{{$color->color_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="size_id" class="form-label">Size</label>
                    <select name="size_id" class="form-control">
                        <option value="">Select Size</option>
                        @foreach (App\Models\Size::where('category_id', $product->category_id)->get() as $size )

                        <option value="{{$size->id}}">{{$size->size_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input  type="text" name="quantity"  class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Inventory</button>
                 </div>
            </form>
        </div>
    </div>
</div>

@endsection
