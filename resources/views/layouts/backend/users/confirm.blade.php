@extends('layouts.backend')

@section('title','Delete Confirmation')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Posts
                <small>Delete Confirmation</small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="{{route('home')}}">Dashboard</a></li>
                <li class="active">Delete Confirmation</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                       'method' => 'DELETE',
                       'route' => ['admin_users_delete',$user->id],
                    
                       ]) !!}

                    <div class="col-xs-9">
                        <div class="box">
                            <div class="box-body">
                                <p>
                                    You have specified this user for deletion:
                                </p>
                                <p>
                                    ID #{{$user->id}}: {{$user->name}}
                                </p>
                                <p>
                                    What should be done to this user?
                                </p>
                                <p>
                                    <input type="radio" name="delete_option" value="delete" checked>Delete all the content.
                                </p>
                                <p>
                                    <input type="radio" name="delete_option" value="attribute">Attribute content to:
                                    {!!Form::select('select_user',$users,null)!!}
                                </p>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                <a href="{{route('admin_users_index')}}" class="btn btn-default">Cancel</a>

                            </div>

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@include('layouts.backend.users.script')