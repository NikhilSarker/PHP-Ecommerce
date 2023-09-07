@extends('layouts.admin')

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Inventory of <strong>{{$product->product_name}}</strong> </h3>
            <a href="{{route('product.list')}}" class="btn btn-primary"><i class="fa fa-list"></i> Product List</a>
        </div>
        <div class="card-body">
            <table class="table table-covered">
                <tr>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                @foreach ($inventories as $inventory)
                <tr>
                    <td>{{$inventory->rel_to_color->color_name}}</td>
                    <td>{{$inventory->rel_to_size->size_name}}</td>
                    <td>{{$inventory->quantity}}</td>
                    <td>
                        <a title="Edit" href="" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i>&nbsp;</a>
                        <a title="Delete" href=""  class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>

</div>
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
