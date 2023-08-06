@extends('layouts.admin')

@section('content')
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-head">
            <h3>Edit Brand</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>

            @endif
            <form action="{{ route('brand.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="brand_id" value="{{$brand->id}}">
                    <label for="brand_name" class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{$brand->brand_name}}">
                    @error('brand_name')
                    <strong class="text-danger">{{$message}}</strong>

                    @enderror
                </div>
                <div class="mb-3">
                    <label for="brand_logo" class="form-label">Brand Logo</label>
                    <input type="file" name="brand_logo" id="brand_logo"  class="form-control"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @error('brand_logo')
                    <strong class="text-danger">{{$message}}</strong>

                    @enderror
                    <div class="my-2">
                        <img id="blah" width="100px" src="{{asset('uploads/brand')}}/{{$brand->brand_logo}}" alt="">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
