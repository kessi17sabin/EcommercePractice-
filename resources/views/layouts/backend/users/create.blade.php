@extends('layouts.backend')

@section('title','Create User')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Posts
                <small>Add New User</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
                <li class="active">Add new</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                       'method' => 'POST',
                       'route' => 'admin_users_store',
                       'files'  =>true,
                       'id'     => 'user-form'
                       ]) !!}

@include('layouts.backend.users.form')

                {!! Form::close() !!}

            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@include('layouts.backend.users.script')