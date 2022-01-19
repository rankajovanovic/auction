<div class="row">
  @foreach($popularItems as $item)
  <!-- Auction Post -->
  <div class="col-xl-4 col-md-4 mb-4">
    <div class="card shadow" style="height:auto">
      <div class="" style="height:200px">
        @if($item->image)
        <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap" style="max-height:200px">
        @else
        <img class="card-img-top" src="http://placehold.it/300x300" alt="Card image cap">
        @endif
      </div>
      <div class="card-body">
        <h4 class="card-title">{{$item->name}}</h4>
        <span>Price: {{ $item->bids->isNotEmpty() ? $item->bids->max('price') : $item->price }}$</span>
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