<x-admin-home>
  @section('content')
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">All users</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Permissions</th>
              <th>Number of items</th>
              <th>Number of bids</th>
              <th>Created at</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>
                <a href="{{ route('users.profile', $user->id) }}">{{$user->first_name}} {{$user->last_name}}</a>
              </td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($roles as $role)
                @if($user->userHasRole($role->name))
                {{$role->name}} <br>
                @endif
                @endforeach
              </td>
              <td>
                @foreach($user->permissions as $per)
                {{$per->name}}
                @endforeach
              </td>
              <td>
                {{count($user->items)}}
              </td>
              <td>
                {{count($user->bids)}}
              </td>
              <td>{{$user->created_at->diffForhumans()}}</td>
              <td>
                <form action="{{route('admin.users.delete', $user->id)}}" method="post">
                  <input type="hidden" name="_method" value="delete" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button class="btn" type="submit">
                    <i class="fas fa-2x	 fa-trash-alt text-danger"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection
</x-admin-home>