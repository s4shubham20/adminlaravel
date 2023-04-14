@extends('back.layouts.main')
@push('title')
    <title>Admin Dashboard || Edit Brand</title>
@endpush
@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Brands</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Brands</h3>

                    <div class="card-tools">
                        <a href="{{ route('brand.index') }}">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-eye"></i> View Brand
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- print_r($errors) --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <div class="input-group">
                                        <input type="hidden" id="ubrandId" value="{{ $brand->id }}">
                                        <input type="text"
                                            class="form-control @error('name'){{ 'border-danger' }} @enderror"
                                            name="name" placeholder="Name" value="{{ old('name' , $brand->name) }}">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug:</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('slug'){{ 'border-danger' }} @enderror"
                                            name="slug" placeholder="Slug" value="{{ old('slug', $brand->slug) }}">
                                    </div>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <div class="input-group">
                                        <select class="select2 @error('category'){{ 'border-danger' }}  @enderror"
                                            id="brandcategoryId" name="category" style="width: 100%;">
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == $brand->id) {{ 'selected' }} @endif>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <div class="select2-purple">
                                        <select class="select2 @error('subcategory'){{ 'border-danger' }} @enderror"
                                            name="subcategory[]" id="brandsubcategoryId" multiple="multiple"
                                            data-placeholder="Select a State" data-dropdown-css-class="select2-purple"
                                            style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                @error('subcategory')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- /.form-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Image:</label>
                                    <img src="{{ asset(''.$brand->image) }}" alt="{{ $brand->alt }}" width="100">
                                    <div class="input-group">
                                        <input type="file"
                                            class="form-control @error('image'){{ 'border-danger' }} @enderror"
                                            name="image" value="{{ old('image') }}">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Status:</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="status" id="radioDanger1" value="1" @if ($brand->status==1){{ "checked" }}@endif>
                                        <label for="radioDanger1">Active</label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="status" id="radioDanger2" value="0" @if ($brand->status==0){{ "checked" }}@endif>
                                        <label for="radioDanger2">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
