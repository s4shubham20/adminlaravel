@extends('back.layouts.main')
@push('title')
    <title>Trash Sub Category</title>
@endpush
@section('main-section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Category</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Sub Category</h3>

                    <div class="card-tools">
                        <a href="{{route('subcategory.index')}}"><button type="button" class="btn btn-warning"><i class="fas fa-eye"></i> View Subcategory
                        </button></a>
                        <a href="{{route('subcategory.create')}}"><button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Record
                        </button></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subacategories as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $eid = Crypt::encryptString($item->id);
                                    @endphp 
                                    <a href="{{route('subcategory.restore',$eid)}}"><button class="btn btn-info btn-sm"><i class="fas fa-trash-restore"></i></button></a>
                                    <a href="{{route('subcategory.forecedelete',$eid)}}">
                                        <button class="btn btn-danger btn-sm"  onclick="return DeleteConfirmation('');"><i class="fas fa-trash"></i></button>
                                    </a>    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div> 
@endsection