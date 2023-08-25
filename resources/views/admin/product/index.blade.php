@extends('layouts.admin')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Product</h3>
                <a href="{{route('product.list')}}" class="btn btn-primary"><i class="fa fa-list"></i> Product List</a>
            </div>
            <div class="card-body">
                @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>

            @endif
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="subcategory" class="form-label">Subcategory</label>
                                <select name="subcategory" id="subcategory" class="form-control">
                                    <option value="">Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Product Brand</label>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control">
                                @error('product_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control">
                                @error('price')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" name="discount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" name="tags[]" class="form-control" id="input-tags">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description</label>

                                <textarea type="text" name="short_description" id="summernote"  class="form-control" cols="60" rows="5"></textarea>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="long_description" class="form-label">Long Description</label>
                                <textarea  type="text"  id="summernote2" class="form-control" name="long_description"  cols="60"
                                    rows="5"></textarea>
                                    @error('long_description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="additional_information" class="form-label">Additional Information</label>
                                <textarea type="text" id="summernote3" class="form-control" name="additional_information" cols="60"
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="preview_image" class="form-label">Preview Image</label> <br>
                                <input name="preview_image" type="file" name="preview_image" id="preview_image"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <div class="my-2">
                                    <img width="100px" id="blah" src="" alt="">
                                </div>
                                @error('preview_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="gallery_image" class="form-label">Gallery Image</label> <br>
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p>Upload images</p>
                                            <input name="gallery_image[]" type="file" multiple=""
                                                data-max_length="20" class="upload__inputfile">
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                    @error('gallery_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 m-auto">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add New Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


@section('footer_script')
    <script>
        $('#category').change(function() {
            let categoryId = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'getSubcategory',
                data: {
                    'categoryId': categoryId
                },
                success: function(data) {
                    $('#subcategory').html(data);
                }

            });
        });
    </script>
    <script>
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#summernote2').summernote();
            $('#summernote3').summernote();
        });
    </script>
    {{-- for gallary images --}}
    <script>
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
@endsection
