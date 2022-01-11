<x-admin-home>
  @section('content')
  <div class="row">

    <!-- Roles table -->
    <div class="col-9">
      <div class="card">
        <div class="card-header ">Roles</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Role</th>
                  <th>Slug</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td>{{$role->slug}}</td>
                  <td>
                    <form action="{{route('admin.roles.destroy', $role) }}" method="post">
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
    </div>

    <!-- Add role form -->
    <div class="col-3">
      <div class="card">
        <div class="card-header ">Add role</div>
        <div class="card-body">
          <form action="{{route('admin.roles.create')}}" method="post">
            @csrf

            <!-- Name input -->
            <div class="form-outline">
              <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                placeholder="Role name">
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <!-- Submit btn -->
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-success mt-4 ">Add</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
</x-admin-home>