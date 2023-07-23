@extends('layouts.admin')

@section('content')

<div class="col-lg-6 m-auto">
  <div class="card">
    <div class="card-header">
      <h2>Admin Panel</h2>
    </div>
    <div class="card-body">
      <p>Welcome to Dashboard, <strong>{{Auth::user()->name}}</strong></p>
    </div>
  </div>
</div>

@endsection