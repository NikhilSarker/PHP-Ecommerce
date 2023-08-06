@extends('layouts.admin')

@section('content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-head">
            <h3>Subcategory List</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($categories as $category )

                <div class="col-lg-12">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h3>{{$category->category_name}}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered ">
                                <tr class="text-center ">
                                    <th>Subcategory Name</th>
                                    <th >Subcategory Image</th>
                                    <th>Action</th>
                                </tr>
                                @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory )
                                <tr class="text-center ">
                                    <td>{{$subcategory->subcategory_name}}</td>
                                    <td >
                                        <img width="100px"
                                            src="{{ asset('uploads/subcategory') }}/{{$subcategory->subcategory_image}}"alt="">
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('subcategory.edit', $subcategory->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i>&nbsp;</a>
                                            <a href=""  class="btn btn-danger shadow btn-xs sharp del_btn"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Subcategory</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>

                @endif
            <form action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <select name="category_name" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category )
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category_name')
                    <strong class="text-danger">{{$message}}</strong>

                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subcategory_name" class="form-label">Subcategory Name</label>
                    <input type="text" name="subcategory_name" class="form-control">
                        @error('subcategory_name')
                        <strong class="text-danger">{{$message}}</strong>

                        @enderror
                </div>
                <div class="mb-3">
                    <label for="subcategory_image" class="form-label">Subcategory Image</label>
                    <input type="file" name="subcategory_image" class="form-control">
                        @error('subcategory_image')
                        <strong class="text-danger">{{$message}}</strong>

                        @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
