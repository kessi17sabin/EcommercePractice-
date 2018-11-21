@extends('layouts.backend')

@section('title','Create Blog')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Posts
                <small>Add new post</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
                <li class="active">Add new</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($post,[
                       'method' => 'POST',
                       'route' => 'admin_blog_store',
                       'files'  =>true,
                       'id'     => 'post-form'
                       ]) !!}

@include('layouts.backend.blog.form')

                {!! Form::close() !!}

            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@include('layouts.backend.blog.script')