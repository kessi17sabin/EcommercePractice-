@extends('layouts.backend')

@section('title','Category')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
            <small>All Categories</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
            <li class="active">Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin_category_create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        @include('layouts.backend.message')
                        @if(! $categories->count())
                    <div class="alert alert-danger">
                        <strong>No record found</strong>
                    </div>
                        @else
                               @include('layouts.backend.category.table')
                         @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            {{$categories->appends(Request::query())->links()}}
                        </ul>
                        <div class="pull-right">
                            <?php $categoriesCount=$categories->count() ?>
                            <small>{{$categoriesCount}} {{str_plural('Item',$categoriesCount)}}</small>
                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>

@endsection