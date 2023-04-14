@extends('back.layouts.main')
@push('title')
    <title>Admin Dashboard || View Brand</title>
@endpush
@section('main-section')
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
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>

                    <div class="card-tools">
                        {{-- @if($trash > 0)
                            <a href="{{route('brand.trash')}}">
                                <button type="button" class="btn btn-warning"><i class="fas fa-plus"></i> View Trash</button>
                            </a>
                        @endif --}}
                        <a href="{{route('brand.create')}}"><button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Record
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
                            {{-- <pre>
                                {{ print_r($brands->toArray()) }}
                            </pre> --}}
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Image</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->category->name}}</td>
                                <td>
                                    @foreach($brand->subcategory as $index => $value)
                                    {{ $value->name }}
                                    @endforeach
                                </td>
                                <td>
                                    <img src="{{asset(''.$brand->image)}}" alt="{{$brand->image}}" width="70" class="img-fluid">
                                </td>
                                <td>{{$brand->created_at}}</td>
                                <td>
                                    @if ($brand->status == 1)
                                        <span class="badge badge-success">{{"Active"}}</span>
                                    @else
                                    <span class="badge badge-danger">{{"Inative"}}</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $eid = Crypt::encryptString($brand->id);
                                    @endphp
                                    @if ($brand->status ==1)
                                    <button class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button>
                                    @else
                                        <button class="btn btn-warning btn-sm disabled"><i class="fas fa-eye"></i></button>
                                    @endif
                                    <a href="{{route('brand.edit',$eid)}}"><button class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button></a>
                                    <form action="{{ route('brand.destroy', $eid) }}" class="inline_form" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return DeleteConfirmation('');"><i class="fas fa-trash"></i></button>
                                    </form>
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
