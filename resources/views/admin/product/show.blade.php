@extends('layouts.admin')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Product Details</h3>
            <a href="{{route('product.list')}}" class="btn btn-primary"><i class="fa fa-list"></i> Product List</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Product Name</td>
                    <td>{{$product->product_name}}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{$product->price}}</td>
                </tr>
                <tr>
                    <td>Short Description</td>
                    <td>{{$product->short_description}}</td>
                </tr>
                <tr>
                    <td>Long Description</td>
                    <td>{{$product->long_description}}</td>
                </tr>
                <tr>
                    <td>Addition Information</td>
                    {{-- <td>{!!$product->additional_information!!}</td> --}}
                    <td>{{$product->additional_information}}</td>
                </tr>
                <tr>
                    <td>Preview Image</td>
                    <td>
                        <img width="200px" src="{{asset('uploads/product/preview-image')}}/{{$product->preview_image}}" alt="">
                    </td>
                </tr>
                <tr>
                    <td>Gallery Images</td>
                    <td>
                        @foreach ($galleries as $gallery)
                        <img width="200px" src="{{asset('uploads/product/gallery-image')}}/{{$gallery->gallery}}" alt="">

                        @endforeach
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
@endsection
