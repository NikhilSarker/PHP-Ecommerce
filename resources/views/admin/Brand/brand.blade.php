@extends('layouts.admin')

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-head">
            <h3>Brand List</h3>
        </div>
        @if (session('deleted'))
        <div class="alert alert-success">{{session('deleted')}}</div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Brand Name</th>
                    <th>Brand Logo</th>
                    <th>Action</th>
                </tr>
                @foreach ($brands as $brand)
                <tr>
                    <td>{{$brand->brand_name}}</td>
                    <td><img width="100px" src="{{asset('uploads/brand')}}/{{$brand->brand_logo}}" alt=""></td>
                    <td>
                        <div class="d-flex">
                            <a href="{{route('brand.edit', $brand->id )}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i>&nbsp;</a>
                            <a href="{{route('brand.delete', $brand->id )}}"  class="btn btn-danger shadow btn-xs sharp del_btn"><i
                                    class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-head">
            <h3>Add New Brand</h3>
        </div>
        @if (session('brand'))
        <div class="alert alert-success">{{ session('brand') }}</div>

        @endif
        <div class="card-body">
            <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="brand_name" class="form-lebel">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control">
                    @error('brand_name')
                    <strong class="text-danger">{{ $message }}</strong>

                    @enderror
                </div>
                <div class="mb-3">
                    <label for="brand_logo" class="form-lebel">Brand Logo</label>
                    <input type="file" name="brand_logo" class="form-control">
                    @error('brand_logo')
                    <strong class="text-danger">{{ $message }}</strong>

                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
