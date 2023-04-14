@extends('back.layouts.main')
@push('title')
    
@endpush
@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Sub Category</li>
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
                    <h3 class="card-title">Add Sub Category</h3>

                    <div class="card-tools">
                        <a href="{{route('subcategory.index')}}"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View Sub Category
                        </button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="{{route('subcategory.store')}}">
                        @csrf
                        <div class="row">
                            {{--print_r($errors)--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name'){{'border-danger'}} @enderror" name="name" placeholder="Category Name" value="{{old('name')}}">
                                    </div>
                                    @error('name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('slug'){{'border-danger'}} @enderror" name="slug" placeholder="Slug Name" value="{{old('slug')}}">
                                    </div>
                                    @error('slug')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <div class="input-group">
                                        <select class="select2 @error('category_id'){{'border-danger'}} @enderror" name="category_id" style="width: 100%;">
                                            @foreach($categories as $item)
                                                <option value="{{old('category_id',$item->id)}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-sm-6">
                                <label>Status:</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="status" id="radioDanger1" value="1">
                                        <label for="radioDanger1">Active</label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="status" id="radioDanger2" checked value="0">
                                        <label for="radioDanger2">Inactive</label>
                                    </div>
                                </div>
                                @error('status')<span class="text-danger">{{$message}}</span>@enderror
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