<x-admin-home>
  @section('content')
  <div class="row mb-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">{{ __('Profile') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('users.update', Auth::user()->id ) }}">
            @csrf
            @method("PUT")

            <div class="row justify-content-center">
              <i class="fas fa-7x fa-meh-rolling-eyes"></i>
            </div>
            <hr>

            <div class="row mb-3">
              <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror"
                  name="username" value="{{ $user->username }}" required autocomplete="name" autofocus>
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                  name="first_name" value="{{ $user->first_name }}" required autocomplete="name" autofocus>
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                  name="last_name" value="{{ $user->last_name }}" required autocomplete="name" autofocus>
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{  $user->email }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="password-confirm"
                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                  autocomplete="new-password">
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Update Profile Data') }}
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      @if(auth()->user()->userHasRole('admin'))
      <div class="card">
        <div class="card-header ">Roles</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Options</th>
                  <th>Id</th>
                  <th>Role</th>
                  <th>Slug</th>
                  <th>Attach</th>
                  <th>Detach</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <td class="text-center">
                    <input type="checkbox" @foreach($user->roles as $user_role)
                    @if($user_role->slug == $role->slug)
                    checked
                    @endif
                    @endforeach
                    >
                  </td>
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td>{{$role->slug}}</td>
                  <td class="text-center">
                    <form action="{{route('admin.users.role.attach', $user)}}" method="post">
                      @method('PUT') @csrf
                      <input type="hidden" name="role" value="{{$role->id}}">
                      <button class="btn text-primary" type="submit" @if($user->roles->contains($role))
                        disabled
                        @endif>
                        <i class="fas fa-paperclip"></i>
                      </button>
                    </form>
                  </td>
                  <td class="text-center">
                    <form action="{{route('admin.users.role.detach', $user)}}" method="post">
                      @method('PUT') @csrf
                      <input type="hidden" name="role" value="{{$role->id}}">
                      <button class="btn text-danger" type="submit" @if(!$user->roles->contains($role))
                        disabled
                        @endif>
                        <i class="fas fa-unlink"></i>
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
      @endif
    </div>

  </div>

  @endsection
</x-admin-home>