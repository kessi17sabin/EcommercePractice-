<table class="table table-bordered table-condesed">
    <thead>
    <tr>
        <th>Action</th>
        <th>Title</th>
        <th>Post Count</th>

    </tr>
    </thead>
    @foreach($categories as $category)
        <tbody>
        <tr>
            <td width="70">
                {!! Form::open(['method'=>'DELETE', 'route'=>['admin_category_delete',$category->id]]) !!}
                <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{route('admin_category_edit',$category->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                @if($category->id == config('cms.default_category_id'))
                <button onclick="return false;" title="Delete" class="btn btn-xs btn-danger delete-row 
                disabled">
                    <i class="fa fa-trash"></i>
                </button>
                @else
                <button onclick="return confirm('Are you sure you want to delete?');" title="Delete" class="btn btn-xs btn-danger delete-row">
                    <i class="fa fa-trash"></i>
                </button>
                 @endif   
                {!! Form::close() !!}
            </td>
            <td>{{$category->title}}</td>
            <td>{{$category->posts->count()}}</td>

        </tr>

        </tbody>
    @endforeach
</table>