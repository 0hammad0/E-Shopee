@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Product <a href="{{ route('product.create') }}"
                            class="btn btn-primary btn-rounded btn-sm float-end text-white">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Product Images</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            {{-- Home --}}
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="my-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="category_id" name="category"
                                            aria-label="Floating label select">
                                            <option value="" selected disabled>select category
                                            </option>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                </option>
                                            @empty
                                                <option value="" selected disabled>No options
                                                    available</option>
                                            @endforelse
                                        </select>
                                        <label for="category_id">select options</label>
                                        @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="enter product name">
                                        <label for="name">product Name</label>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            placeholder="enter product name">
                                        <label for="slug">product Slug</label>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating">
                                        <select class="form-select" id="brand_id" name="brand"
                                            aria-label="Floating label select">
                                            <option value="" selected disabled>select brand</option>
                                            @forelse ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}
                                                </option>
                                            @empty
                                                <option value="" selected disabled>No options
                                                    available</option>
                                            @endforelse
                                        </select>
                                        <label for="brand_id">select options</label>
                                        @error('brand')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating my-3">
                                        <textarea class="form-control" placeholder="small description" name="small_description" id="small_description"
                                            style="height: 100px"></textarea>
                                        <label for="small_description">product small description
                                            (500)</label>
                                        @error('small_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating my-3">
                                        <textarea class="form-control" placeholder="description" name="description" id="description" rows="4"
                                            style="height: 120px"></textarea>
                                        <label for="description">description</label>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- SEO --}}
                            <div class="tab-pane fade" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab"
                                tabindex="0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        placeholder="enter product name">
                                    <label for="meta_title">Product meta title</label>
                                    @error('meta_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-floating my-3">
                                    <textarea class="form-control" placeholder="meta description" name="meta_description" id="meta_description"
                                        style="height: 100px"></textarea>
                                    <label for="meta_description">meta description</label>
                                    @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-floating my-3">
                                    <textarea class="form-control" placeholder="meta keywords" name="meta_keyword" id="meta_keyword" rows="4"
                                        style="height: 120px"></textarea>
                                    <label for="meta_keyword">meta keywords</label>
                                    @error('meta_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Details --}}
                            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" id="original_price"
                                                name="original_price" placeholder="enter product orignal price">
                                            <label for="original_price">Orignal price</label>
                                            @error('original_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" id="selling_price"
                                                name="selling_price" placeholder="enter product selling price">
                                            <label for="selling_price">Selling price</label>
                                        </div>
                                        @error('selling_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating my-3">
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="enter product quantity">
                                            <label for="quantity">Quantity</label>
                                            @error('quantity')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <input type="checkbox" id="trending" name="trending">
                                            <label for="trending">
                                                Trending
                                            </label>
                                            @error('trending')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <input type="checkbox" id="status" name="status">
                                            <label for="status">
                                                Status
                                            </label>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Product Image --}}
                            <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                                tabindex="0">
                                <div class="">
                                    <div class="input-group my-3">
                                        <input type="file" name="image[]" multiple class="form-control"
                                            id="product_image">
                                        <label class="input-group-text" for="product_image">Upload Images</label>
                                    </div>
                                    <div class="mb-4">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div>
                            <button class="btn btn-primary btn-rounded text-white float-end"
                                type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
