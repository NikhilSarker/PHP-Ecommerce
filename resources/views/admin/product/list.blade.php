@extends('layouts.admin')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Product List</h3>
            <a class="btn btn-primary" href="{{ route('product') }}"><i class="fa fa-plus"></i> Add New Product</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>

            @endif
            <table class="table table-covered">
                <tr class="bg-light">
                    <th>SL</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Brand</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount(%)</th>
                    <th>After Discount</th>
                    <th>Preview Image</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $sl => $product )
                <tr>
                    <td>{{$sl+1}}</td>
                    <td><input class="check" data-id="{{$product->id}}" {{$product->status==1?'checked':''}} type="checkbox"  data-toggle="toggle" data-onstyle="info" data-size="small" value="{{$product->status}}"></td>
                    <td>{{ $product->rel_to_category->category_name}}</td>
                    <td>{{ $product->rel_to_subcategory->subcategory_name}}</td>
                    <td>{{ $product->rel_to_brand->brand_name}}</td>
                    <td>{{ $product->product_name}}</td>
                    <td class="text-center">{{ $product->price}}</td>
                    <td class="text-center">{{ $product->discount}}</td>
                    <td class="text-center">{{ $product->after_discount}}</td>
                    <td>
                        <img width="100px" src="{{asset('uploads/product/preview-image')}}/{{$product->preview_image}}" alt="">
                    </td>
                    <td>
                        <div class="d-flex">
                            <a title="Inventory" href="{{route('inventory', $product->id)}}" class="btn btn-success shadow btn-xs sharp del_btn "><i class="fa fa-archive"></i></a>&nbsp;&nbsp;
                            <a title="View" href="{{route('product.show', $product->id)}}" class="btn btn-info shadow btn-xs sharp del_btn"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                            <a title="Delete" href="{{route('product.delete', $product->id)}}"  class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>

                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script>
    $('.check').change(function(){
        if($(this).val()==1){
            $(this).attr('value', 0);
        }else{
            $(this).attr('value', 1);

        }
        var status = $(this).val();
        var product_id = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/changeStatus',
            data: {
                'product_id': product_id,
                'status': status,
            },
            success: function(data) {
                // alert(data)
            }

        });
    });
</script>

@endsection
