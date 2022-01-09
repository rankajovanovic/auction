<x-auction-home>
  @section('content')
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <!-- Author -->
      <h6 class="m-0">by
        {{ !empty($item->user) ? $item->user->first_name : '' }}
        {{ !empty($item->user) ? $item->user->last_name : '' }}
      </h6>
    </div>
    <div class="card-body">

      <div class="row">

        <!-- Price card -->
        <div class="col-auto mr-auto">

          <!-- Item name -->
          <h2 class="">{{$item->name}}</h2>
        </div>
        <div class="col-auto">
          @can('view', $item)
          <form action="{{route('items.delete', $item->id)}}" method="post">
            <input type="hidden" name="_method" value="delete" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                class="bi bi-trash" viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>
          </form>
          @endcan
        </div>
      </div>
      <hr>

      <!-- Date/Time -->
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

      <!-- Preview Image -->
      @if($item->image)
      <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap"
        style="max-height:400px; width: auto">
      @else
      <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
      @endif

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

        <!-- Price card -->
        <div class="col-xl-6">
          <div class="card text-dark text-center border-danger">
            <div class="card-header p-2">
              PRICE
            </div>
            <div class="card-body text-danger">
              <h4> {{$item->price}} $</h4>
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
                    <input type="number" min="{{$item->price}}" id="price"
                      class="form-control @error('price') is-invalid @enderror" value="{{$item->price}}" name="price" />
                  </div>
                  <div class="col-xl-3">
                    <button type="submit" class="btn btn-warning">Add</button>
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
      </div>
      <!-- End row -->
    </div>
  </div>
  @endsection
</x-auction-home>