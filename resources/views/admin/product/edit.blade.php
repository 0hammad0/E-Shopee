@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Add Cateogry <a href="{{ route('category') }}"
                            class="btn btn-info btn-rounded btn-sm float-end text-white">back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="cateogoryName"
                                placeholder="Category name..." value="{{ $category->name }}" />
                            @error('cateogoryName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug:</label>
                            <input type="text" class="form-control" id="slug" name="categorySlug"
                                placeholder="Slug..." value="{{ $category->slug }}">
                            @error('categorySlug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="categoryDescription" id="description" rows="4" placeholder="description...">{{ $category->description }}</textarea>
                            @error('categoryDescription')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Image upload:</label>
                            <input type="file" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control file-upload-info" placeholder="Upload Image"
                                    name="categoryImage">
                            </div>
                            <div class="mt-3">
                                <img src="{{ asset('/uploads/category/' . $category->image) }}"
                                    alt="{{ $category->image }}" width="120px" height="120px">
                            </div>
                            @error('categoryImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="categoryStatus">
                                @if ($category->status == '1')
                                    <option value="1" selected>Active</option>
                                    <option value="0">Deactive</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Deactive</option>
                                @endif
                            </select>
                            @error('categoryStatus')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>
                        <legend class="">SEO Tags:</legend>
                        <hr>

                        <div class="form-group">
                            <label for="meta_title">Meta Title:</label>
                            <input type="text" class="form-control" name="categoryMetaTitle" id="meta_title"
                                placeholder="meta title..." value="{{ $category->meta_title }}">
                            @error('categoryMetaTitle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keyword">Meta Keywords:</label>
                            <textarea class="form-control" name="categoryMetaKeyword" id="meta_keyword" rows="4"
                                placeholder="meta keywords...">{{ $category->meta_keyword }}</textarea>
                            @error('categoryMetaKeyword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description:</label>
                            <textarea class="form-control" name="categoryMetaDescription" id="meta_description" rows="4"
                                placeholder="meta description...">{{ $category->meta_description }}</textarea>
                            @error('categoryMetaDescription')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-rounded btn-fw text-white">Update</button>
                        <button class="btn btn-light btn-rounded btn-fw mx-4">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
