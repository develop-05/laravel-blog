@extends('admin.layouts.default')

@section('title', 'Categories')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Categories</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">

                                <a href="{{ route('categories.create') }}" class="btn btn-primary">Add category</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" role="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px" scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th style="width: 150px" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="align-middle">
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td class=" d-flex gap-2">
                                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                                        class="btn btn-info">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', ['category' => $category->id])}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" onclick="return confirm('confirm action')"><i class="bi bi-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $categories->links('vendor.pagination.bootstrap-5-admin') }}
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--end::Col-->
        </div>

        <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content-->

@endsection
