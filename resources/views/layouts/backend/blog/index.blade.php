@extends('layouts.backend')

@section('title','Dashboard')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Posts
            <small>All Blog Posts</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
            <li class="active">Posts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin_blog_create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                        <div class="pull-right" style="padding: 6px 0;">
                            <a href="?status=all">All</a> |
                            <a href="?status=trash">Trash</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        @include('layouts.backend.message')
                        @if(! $posts->count())
                    <div class="alert alert-danger">
                        <strong>No record found</strong>
                    </div>
                        @else

                           @if($onlyTrashed)
                               @include('layouts.backend.blog.table-trash')
                           @else
                               @include('layouts.backend.blog.table')
                           @endif
                         @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            {{$posts->appends(Request::query())->links()}}
                        </ul>
                        <div class="pull-right">
                            <?php $postCount=$posts->count() ?>
                            <small>{{$postCount}} {{str_plural('Item',$postCount)}}</small>
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