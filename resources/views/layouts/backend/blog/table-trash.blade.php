<table class="table table-bordered table-condesed">
    <thead>
    <tr>
        <th>Action</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Date</th>
    </tr>
    </thead>
    @foreach($posts as $post)
        <tbody>
        <tr>
            <td width="70">
                {!! Form::open(['style'=>'display:inline-block;','method'=>'PUT', 'route'=>['admin_blog_restore',$post->id]]) !!}
                <button title="restore" class="btn btn-xs btn-default edit-row">
                    <i class="fa fa-refresh"></i>
                </button>
                {!! Form::close() !!}

                {!! Form::open(['style'=>'display:inline-block;','method'=>'DELETE', 'route'=>['admin_blog_force-destroy',$post->id]]) !!}
                <button title="Delete" onclick="return confirm('Are you sure you want to delete this file permanently?')" class="btn btn-xs btn-danger delete-row">
                    <i class="fa fa-times"></i>
                </button>

                {!! Form::close() !!}
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->title}}</td>
            <td><abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr> </td>

        </tr>

        </tbody>
    @endforeach
</table>