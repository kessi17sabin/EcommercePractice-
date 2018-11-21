@extends('layouts.backend')

@section('title','Users')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>All Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a id="add-button" title="Add New" class="btn btn-success" href="{{route('admin_users_create')}}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        @include('layouts.backend.message')
                        @if(! $users->count())
                    <div class="alert alert-danger">
                        <strong>No record found</strong>
                    </div>
                        @else
                               @include('layouts.backend.users.table')
                         @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            {{$users->appends(Request::query())->links()}}
                        </ul>
                        <div class="pull-right">
                            <?php $usersCount=$users->count() ?>
                            <small>{{$usersCount}} {{str_plural('Item',$usersCount)}}</small>
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