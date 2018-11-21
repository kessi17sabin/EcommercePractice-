@extends('layouts.backend')

@section('title','Edit category')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categroy
                <small>Edit Category</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
                <li class="active">Add new</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($category,[
                       'method' => 'PUT',
                       'route' => ['admin_category_update',$category->id],
                       'files'  =>true,
                       'id'     => 'post-form'
                       ]) !!}

@include('layouts.backend.category.form')

                {!! Form::close() !!}

            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@include('layouts.backend.category.script')