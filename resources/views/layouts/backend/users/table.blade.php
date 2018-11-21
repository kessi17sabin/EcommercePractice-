<table class="table table-bordered table-condesed">
    <thead>
    <tr>
        <th>Action</th>
        <th>Users</th>
        <th>Email</th>
        <th>Role</th>

    </tr>
    </thead>
    @foreach($users as $user)
        <tbody>
        <tr>
            <td width="70">
                
                <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{route('admin_users_edit',$user->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                @if($user->id == config('cms.default_user_id'))
                <a onclick="return false;" title="Delete" class="btn btn-xs btn-danger delete-row 
                disabled">
                    <i class="fa fa-trash"></i>
                </a>
                @else
                <a href="{{route('admin_users_confirm',$user->id)}}" 
                        onclick="return confirm('Are you sure you want to delete?');" title="Delete" class="btn btn-xs btn-danger delete-row">
                    <i class="fa fa-trash"></i>
                </a>
                 @endif   
                
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>-</td>

        </tr>

        </tbody>
    @endforeach
</table>