@extends('layouts.admin')

@section('content')
    <div class="col-lg-8">
        <form action="{{route('restore.checked')}}" method="post">
            @csrf
        <div class="card">
            <div class="card-header">
                <h3>Trash Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll">Check All</label>
                            </div>
                        </th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($trash_category as $sl => $category)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" name="category_id[]" value="{{$category->id}}" id="cat{{$category->id}}">
                                    <label class="custom-control-label" for="cat{{$category->id}}"></label>
                                </div>
                            </td>
                            <td>{{ $sl + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img width="50px"
                                    src="{{ asset('uploads/category') }}/{{ $category->category_image }}"alt="">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a title="Restore" href="{{ route('category.restore', $category->id) }}"class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                            class="fa fa-reply"></i>&nbsp;</a>
                                    <a title="Delete" href="{{ route('category.hard.delete', $category->id) }}"
                                        class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center ">No Trash Found!</td>
                        </tr>
                    @endforelse
                </table>
                <button type="submit" class="btn btn-info">Restore Checked</button>
            </div>
        </div>
    </form>
    </div>
@endsection


@section('footer_script')
    <script>
        $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
