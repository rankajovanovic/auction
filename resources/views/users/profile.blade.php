<x-admin-home>
  @section('content')
  <div class="row">

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fas fa-4x fa-id-card-alt text-primary"></i>
            </div>
            <div class="col ml-5">
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">Profile</div>

                <div>
                  <small>Name:</small>
                  {{$user->first_name}} {{$user->last_name}}
                </div>

                <div>
                  <small>Email:</small>
                  {{$user->email}}
                </div>

                <div>
                  <small>Role:</small>
                  @foreach($user->roles as $role)
                  @if($user->userHasRole($role->name))
                  {{$role->name}};
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            @can('view', $user)
            <div class="col-auto">
              <a class="btn" href="{{ route('users.settings', $user->id)}}"> <i class="fas fa-2x fa-edit"></i> </a>
            </div>
            @endcan
          </div>
        </div>
      </div>
    </div>
    @if(auth()->user()->userHasRole('Super Admin') or $user->id == auth()->id() )
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Earnings (Monthly)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">${{$data['sumMonthlyEarning']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Total)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">${{$data['sumSelledItems']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total spend</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">${{$data['sumPurchasedItems']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>

  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Items</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['countActiveItems']}}</div>
            </div>
            <div class="col-auto">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                class="bi fs-2 mb-3 bi-cart-check-fill text-gray-300" viewBox="0 0 16 16">
                <path
                  d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z" />
              </svg>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Purchased Items</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['countPurchasedItems']}}</div>
            </div>
            <div class="col-auto">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                class="bi bi-cart-x-fill fs-2 mb-3 text-gray-300" viewBox="0 0 16 16">
                <path
                  d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />

              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Selled Items</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data['countSelledItems']}}</div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="bi bi-cart-dash-fill"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                class="bi bi-cart-dash-fill fs-2 mb-3 text-gray-300" viewBox="0 0 16 16">
                <path
                  d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z" />
              </svg>
              <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total bids</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['countBids']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments-dollar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @if($data['items']->isNotEmpty())
  <section class="pt-1 pb-1">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3">Items </h3>
        </div>
        @if(count($data['items']) > 3)
        <div class="col-6 text-right">
          <a class="btn btn-primary mb-3 mr-1" href="#profilecarusel" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
          </a>
          <a class="btn btn-primary mb-3 " href="#profilecarusel" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
        @endif
        <div class="col-12">
          <div id="profilecarusel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($data['items']->chunk(3) as $itemsCollection)
              <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                <div class="row">
                  @foreach ($itemsCollection as $item)
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="" style="height:250px">
                        @if($item->image)
                        <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap"
                          style="max-height:250px">
                        @else
                        <img class="card-img-top" src="http://placehold.it/150x60" alt="Card image cap">
                        @endif
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                          <a href="{{route('items.show', $item->slug )}}">{{$item->name}}</a>
                        </h5>
                        <div class="row">
                          <div class="col">
                            <span>
                              {{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}$</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  @endsection
</x-admin-home>