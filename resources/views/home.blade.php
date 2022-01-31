<x-auction-home>
  @section('content')
  <h1 class="my-4">All items
    <small>
      @if(isset($category))
      - {{$category->name}}
      @endif
    </small>
  </h1>

  <div class="row">
    @foreach($items as $item)
    <!-- Auction Post -->
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card shadow" style="height:auto">
        <div class="" style="height:200px">
          @if($item->image)
          <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap" style="max-height:200px">
          @else
          <img class="card-img-top" src="http://placehold.it/150x150" alt="Card image cap" style="max-height:200px">
          @endif
        </div>
        <div class="card-body">
          <h4 class="card-title">{{$item->name}}</h4>
          <span>Price: ${{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}</span>
          <hr class="sidebar-divider">
          <span class="pr-2 text-danger"><small data-countdown="{{ $item->end_time }}"></small></span>
          <a href="{{route('items.show', $item->slug )}}" class="btn btn-primary btn-sm">More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
          <small>
            Posted on {{ $item->created_at->diffForHumans() }}
            <br>
            <!-- by
            {{ !empty($item->user) ? $item->user->email : '' }} -->
          </small>
        </div>
      </div>
    </div>
    @endforeach

    @if(count($items) == 0)
    <div>
      There are no items to show in this view.
    </div>
    @endif
  </div>
  <!-- Pagination -->
  <div class="main-navigation mt-4">
    {{ $items->appends(request()->input())->links("pagination::bootstrap-4") }}
  </div>
  <hr>

  @if( $popularItems->isNotEmpty() )
  <section class="pt-4 pb-4">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3">Popular items </h3>
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
          </a>
          <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
        <div class="col-12">
          <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($popularItems->chunk(3) as $itemsCollection)
              <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                <div class="row">
                  @foreach ($itemsCollection as $item)
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="" style="height:150px">
                        @if($item->image)
                        <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap"
                          style="max-height:150px">
                        @else
                        <img class="card-img-top" src="http://placehold.it/150x150" alt="Card image cap"
                          style="max-height:150px">
                        @endif
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                          <a href="{{route('items.show', $item->slug )}}">{{$item->name}}</a>
                        </h5>
                        <div class="row">
                          <div class="col">
                            <span>
                              ${{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}</span>
                          </div>
                          <div class="col">
                            <span class="badge badge-pill badge-warning">{{ $item->bids_count }} bids </span>
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

  @if( $mostExpensiveItems->isNotEmpty() )
  <section class="pt-1 pb-1">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3"> {{count($mostExpensiveItems)}} Most expensive items </h3>
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators3" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
          </a>
          <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators3" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
        <div class="col-12">
          <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($mostExpensiveItems->chunk(3) as $itemsCollection)
              <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                <div class="row">
                  @foreach ($itemsCollection as $item)
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="" style="height:150px">
                        @if($item->image)
                        <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap"
                          style="max-height:150px">
                        @else
                        <img class="card-img-top" src="http://placehold.it/150x150" alt="Card image cap"
                          style="max-height:150px">
                        @endif
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                          <a href="{{route('items.show', $item->slug )}}">{{$item->name}}</a>
                        </h5>
                        <div class="row">
                          <div class="col">
                            <span>${{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}</span>
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


  @section('side-bar')
  @include('./components/auction-sidebar')
  @endsection

</x-auction-home>