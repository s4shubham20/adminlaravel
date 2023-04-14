@extends('back.layouts.main')
@push('title')
    <title>Dashboard | Category</title>
@endpush
@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Advanced Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Advanced Form</li>
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
                    <h3 class="card-title">Add Category</h3>

                    <div class="card-tools">
                        <a href="{{route('category.index')}}"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> View Category
                        </button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                @php
                    $eid = Crypt::encryptString($category->id);
                @endphp
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{route('category.update',$eid)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{--print_r($errors)--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$category->name ?? old('category')}}">
                                    </div>
                                    @error('name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="slug" placeholder="Slug Name" value="{{$category->slug ?? old('slug')}}">
                                    </div>
                                    @error('slug')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-sm-6">
                                <label>Status:</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="status" id="radioDanger1" value="1" {{$category->status == 1 ? "checked" : ""}}>
                                        <label for="radioDanger1">Active</label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="status" id="radioDanger2" checked value="0" {{$category->status == 0 ? "checked" : ""}}>
                                        <label for="radioDanger2">Inactive</label>
                                    </div>
                                </div>
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