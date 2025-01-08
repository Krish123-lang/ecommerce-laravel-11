@extends('layouts.admin')

{{-- @push('styles')
    <style>
        .item.gitems {
            display: flex;
            flex-direction: column;
            align-items: center;    
            margin: 10px;           
        }
        .gallery-img {
            max-width: 100%;       
            height: auto;
            margin-bottom: 8px;    
        }
        .remove-img {
            background-color: #f44336; 
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .remove-img:hover {
            background-color: #d32f2f;
            color: #fff;
        }
    </style>
@endpush --}}

@section('content')

    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name"
                            name="name" tabindex="0" value="{{ $product->name }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('name')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug"
                            name="slug" tabindex="0" value="{{ $product->slug }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('slug')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Choose category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{$product->category_id==$category->id?"selected":""}}>{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{$product->brand_id==$brand->id?"selected":""}}>{{ $brand->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description <span
                                class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description"
                            placeholder="Short Description" tabindex="0" aria-required="true"
                            required="">{{ $product->short_description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('short_description')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror


                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description"
                            tabindex="0" aria-required="true" required="">{{$product->description}}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('description')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($product->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                    class="effect8" alt="{{ $product->name }}">
                                </div>
                            @endif

                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror


                    <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16">

                            @if ($product->images)
                                @foreach (explode(',',$product->images) as $img)
                                    <div class="item gitems">
                                        <img src="{{ asset('uploads/products') }}/{{trim($img)}}" alt="">
                                    </div>       
                                @endforeach
                            @endif

                            {{-- Chatgpt --}}
                            {{-- @if ($product->images)
                                <div id="existingGallery" class="d-flex">
                                    @foreach (explode(',', $product->images) as $img)
                                        <div class="item gitems">
                                            <img src="{{ asset('uploads/products') }}/{{ trim($img) }}" alt="" class="gallery-img">
                                            <button type="button" class="remove-img" data-filename="{{ trim($img) }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif --}}
                            {{-- Chatgpt --}}
                            
                            
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                        multiple>
                                </label>
                            </div>

                            {{-- chatgpt --}}
                            {{-- <div id="galleryContainer" class="gallery-container d-flex"></div>
                            <input type="hidden" name="deleted_images" id="deletedImages" value=""> --}}
                            {{-- chatgpt --}}
                        </div>
                    </fieldset>
                    @error('images')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price"
                                name="regular_price" tabindex="0" value="{{$product->regular_price}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('regular_price')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price"
                                name="sale_price" tabindex="0" value="{{$product->sale_price}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('sale_price')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU"
                                tabindex="0" value="{{$product->SKU}}" aria-required="true" required="">
                        </fieldset>
                        @error('SKU')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity"
                                name="quantity" tabindex="0" value="{{$product->quantity}}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('quantity')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock" {{$product->stock_status=="instock"?"selected":""}}>InStock</option>
                                    <option value="outofstock" {{$product->stock_status=="outofstock"?"selected":""}}>Out of Stock</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('stock_status')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0" {{$product->featured=="0"?"selected":""}}>No</option>
                                    <option value="1" {{$product->featured=="1"?"selected":""}}>Yes</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')<div class="alert alert-danger text-center">{{ $message }}</div>@enderror

                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update product</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
@endsection

@push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change", function(e) {
                const photoInp=$("#myFile");
                const [file]=this.files;
                if (file) {
                    $("#imgpreview img").attr("src",URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("#gFile").on("change", function(e) {
                const photoInp=$("#gFile");
                const gphotos=this.files;
                $.each(gphotos, function(key, val){
                    $("#galUpload").prepend(`<div class="item gitems">
                        <img src="${URL.createObjectURL(val)}" alt="">
                    </div>`);
                })
               
            });

            $("input[name='name']").on("change", function() {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text) {
            return Text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        }
    </script>
@endpush


{{-- chatgpt --}}
{{-- @push('scripts')
<script>
    $(function () {
        $("#myFile").on("change", function(e) {
                const photoInp=$("#myFile");
                const [file]=this.files;
                if (file) {
                    $("#imgpreview img").attr("src",URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });
            
        $("#gFile").on("change", function () {
            const files = this.files;
            const galleryContainer = $("#galleryContainer");
            let imagesHTML = "";

            $.each(files, function (key, file) {
                const imageUrl = URL.createObjectURL(file);
                imagesHTML += `
                    <div class="item gitems">
                        <img src="${imageUrl}" alt="New Image">
                    </div>`;
            });

            galleryContainer.append(imagesHTML);
        });

        $(document).on("click", ".remove-img", function () {
            const filename = $(this).data("filename");
            const deletedImages = $("#deletedImages").val();

            $("#deletedImages").val(deletedImages ? deletedImages + ',' + filename : filename);
            $(this).parent().remove();
        });

        $("input[name='name']").on("change", function () {
            $("input[name='slug']").val(StringToSlug($(this).val()));
        });
    });

    function StringToSlug(Text) {
        return Text.toLowerCase().replace(/[^\w ]+/g, "").replace(/ +/g, "-");
    }
</script>
@endpush --}}
{{-- chatgpt --}}