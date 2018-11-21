@extends('layouts.backend')

@section('title','Edit Blog')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Posts
                <small>Edit post</small>
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
                       'method' => 'PUT',
                       'route' => ['admin_blog_update',$post->id],
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