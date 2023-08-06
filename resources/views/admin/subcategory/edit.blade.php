@extends('layouts.admin')

@section('content')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Subcategory</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('subcategory.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="category_name" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option {{$category->id == $subcategory->category_id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subcategory_name" class="form-label">Subcategory Name</label>
                        <input type="text" name="subcategory_name" class="form-control" value="{{$subcategory->subcategory_name}}">
                        @error('subcategory_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subcategory_image" class="form-label">Subcategory Image</label>
                        <input type="file" name="subcategory_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('subcategory_image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <div class="my-2">
                            <img id="blah" width="100px" src="{{asset('uploads/subcategory')}}/{{$subcategory->subcategory_image}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Edit Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
