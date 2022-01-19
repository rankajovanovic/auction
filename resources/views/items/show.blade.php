<x-auction-home>
  @section('content')

  @if($userBid != null and $item->active == 1)
  <div class="card text-dark text-center border-primary mt-4">
    <div class="card-header p-2 bg-primary text-white">
      Your bid for this item
    </div>
    <div class="card-body ">
      <div class=" row justify-content-center">
        <div class="col-3">
          <div class="row">
            <img src="{{asset('/images/brand/icon.png')}}" width="50" height="50" alt="">
            <h4 class="pt-2">
              ${{ !empty($userBid) ? $userBid->price : ''}}
            </h4>
          </div>
        </div>

        <div class="col-2">
          <form action="{{route('bids.delete', $userBid)}}" method="post">
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill=""
                class="bi bi-trash" viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <!-- Author -->
      <h6 class="m-0">by
        <a href="{{ route('users.profile', $item->user->id)}}">{{ !empty($item->user) ? $item->user->first_name : '' }}
          {{ !empty($item->user) ? $item->user->last_name : '' }}</a>

      </h6>
    </div>
    <div class="card-body">

      <div class="row">

        <!-- Price card -->
        <div class="col-auto mr-auto">

          <!-- Item name -->
          <h2 class="">{{$item->name}}</h2>
        </div>
        @if($item->active == 1)
        <div class="col-auto">
          @can('view', $item)
          <a class="" href="#" data-toggle="modal" data-target="#deleteModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red" class="bi bi-trash"
              viewBox="0 0 16 16">
              <path
                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
              <path fill-rule="evenodd"
                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg>
          </a>
          @endcan
        </div>
        @endif
      </div>
      <hr>


      <!-- Date/Time -->
      @if($item->active == 1)
      <small class="row">
        <div class="col-auto mr-auto">
          <p>Posted on {{$item->created_at->format('d.m.Y')}} at {{$item->created_at->format('h:i A')}}</p>
        </div>

        <div class="col-auto">
          <span class="text-danger">End time: </span>
          <span class="text-danger" data-countdown="{{ $item->end_time }}"></span>
        </div>

      </small>
      <hr>
      @endif


      <div class="row">
        <div class="col-xl-6">
          <!-- Preview Image -->
          @if($item->image)
          <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap"
            style="max-height:400px; width: auto">
          @else
          <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
          @endif
        </div>

        <div class="col-xl-6">
          @if($item->active == 0)
          <h1 class="border border-danger shadow  text-center text-danger">SOLD</h1>
          @endif

          @if(isset($item->buyer) && $item->buyer->id == auth()->user()->id)
          <h1 class="border border-danger shadow  text-center text-danger">you bought this item for
            ${{$item->bid_price}}
          </h1>
          @endif
        </div>
      </div>
      <hr>
      <!-- Item Description -->
      <p>Description: </p>
      <p class="lead">{{$item->description}}
      </p>
      <div>
        <p>Delivery: {{$item->delivery}}</p>
        <p>Payment: {{$item->payment}}</p>
      </div>
      <hr>

      <div class="row">
        @if($item->active == 1)
        <!-- Price card -->
        <div class="col-xl-6">
          <div class="card text-dark text-center border-danger">
            <div class="card-header p-2">
              PRICE
            </div>
            <div class="card-body text-danger">
              <h4>${{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}</h4>
            </div>
          </div>
        </div>

        <!-- Bid card -->
        <div class="col-xl-6">
          <div class="card text-dark text-center bg-success border-success">
            <div class="card-header p-2">
              PLACE BID
            </div>
            <div class="card-body">
              <form method="POST" action="{{route('bids.add', $item->id)}}">
                @csrf
                <div class="row">
                  <div class="col-xl-9">
                    <input type="number"
                      min="{{ $item->bids->isNotEmpty() ? $item->bids->max('price')+1 : $item->price+1}}" id="price"
                      class="form-control @error('price') is-invalid @enderror"
                      value="{{ $item->bids->isNotEmpty() ? $item->bids->max('price')+1 : $item->price+1}}"
                      name="price" />
                  </div>
                  <div class="col-xl-3">
                    <button type="submit" class="btn btn-warning" @if(Auth::check() && auth()->user()->id ==
                      $item->user_id)
                      disabled
                      @endif
                      >Add</button>
                  </div>
                </div>
              </form>
              @error('price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>
        @endif

      </div>
      <!-- End row -->
    </div>
  </div>

  @can('view', $item)

  @if($item->bids->isNotEmpty())
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <!-- Author -->
      <h6 class="m-0">Bids for this item
      </h6>
    </div>
    <div class="card-body">

      @foreach( $item->bids as $bid )
      <!-- Bid card -->
      <div class="col-auto mr-auto">
        {{$bid->user->first_name}} {{$bid->user->last_name}} added bid >>> ${{$bid->price}}
      </div>
      <hr>
      @endforeach

      @if($item->active == 0)
      <h3 class="border border-danger shadow text-center text-danger">ITEM IS SOLD to {{$item->buyer->first_name}}
        {{$item->buyer->last_name}} for ${{$item->bid_price}}
      </h3>
      @endif

    </div>
  </div>
  @endif
  @endcan

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you really want to delete these record? This process cannot be undone.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <a class="btn btn-danger" href="{{route('items.delete', $item->id)}}"
            onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>

          <form id="delete-form" action="{{route('items.delete', $item->id)}}" method="POST" class="d-none">
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>

        </div>
      </div>
    </div>
  </div>


  @endsection

  @section('side-bar')
  @include('./components/auction-sidebar')
  @endsection
</x-auction-home>