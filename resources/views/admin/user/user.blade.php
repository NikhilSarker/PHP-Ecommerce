@extends('layouts.admin')

@section('content')
{{-- User Name And Email Update Start --}}
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h3>Update User Information</h3>
    </div>
    <div class="card-body">
      <form action="{{route('user.info.update')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="name">Name: </label>
          <input type="text" name="name" class="form-control" placeholder="Name" value="{{Auth::user()->name}}">
          @error('name')
          <strong class="text-danger">{{$message}}</strong>

          @enderror
        </div>
        <div class="mb-3">
          <label for="email">Email: </label>
          <input type="email" name="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
          @error('email')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- User Name And Email Update End --}}
{{-- User Password Update Start --}}
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h3>Update User Password</h3>
    </div>
    <div class="card-body">
      @if (session('password_update'))
      <div class="alert alert-success">{{session('password_update')}}</div>
      @endif
      <form action="{{route('user.password.update')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="current_password">Current Password: </label>
          <input type="text" name="current_password" class="form-control" >
          @error('current_password')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
          @if (session('current_password'))
          <strong class="text-danger">{{session('current_password')}}</strong>
          @endif
        </div>
        <div class="mb-3">
          <label for="password">New Password: </label>
          <input type="text" name="password" class="form-control"  >
          <p class="px-3 text-center">Password must contain upper, lower, number and symbol.</p>
          @error('password')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password_confirmation">Confirm Password: </label>
          <input type="text" name="password_confirmation" class="form-control">
          @error('password_confirmation')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- User Password Update End --}}
{{-- User Profile photo Upate Start --}}
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h3>Update User Profile Photo</h3>
    </div>
    <div class="card-body">
      @if (session('photo_update'))
      <div class="alert alert-success">{{session('photo_update')}}</div>
      @endif
      <form action="{{route('user.photo.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="photo">Upload Photo: </label>
          <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" >
          @error('photo')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
          <div class="mt-2">
            <img width="200px" src="" id="blah" alt="">
          </div>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- User Profile photo Upate  End --}}

@endsection
