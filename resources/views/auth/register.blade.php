<x-auction-home>
  @section('content')
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>

              <form class="user" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror"
                    id="first_name" placeholder="Your First Name" name="first_name">
                  @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror"
                    id="last_name" placeholder="Your Last Name" name="last_name">
                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email Address">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password"
                      class="form-control form-control-user  @error('password') is-invalid @enderror" name="password"
                      id="password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password"
                      class="form-control form-control-user @error('password') is-invalid @enderror"
                      id="password-confirm" placeholder="Repeat Password" name="password_confirmation">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" type="submit">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
</x-auction-home>