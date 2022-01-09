<x-auction-home>
  @section('content')
  <h1 class="my-4">All items
    <small></small>
  </h1>

  <div class="row">
    @foreach($items as $item)
    <!-- Auction Post -->
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card" style="height:auto">
        <div class="" style="height:200px">
          @if($item->image)
          <img class="card-img-top img-fluid" src="{{$item->image}}" alt="Card image cap" style="max-height:200px">
          @else
          <img class="card-img-top" src="http://placehold.it/300x300" alt="Card image cap">
          @endif
          <!-- <img class="card-img-top" src="http://placehold.it/300x300" alt="Card image cap"> -->
        </div>
        <div class="card-body">
          <h2 class="card-title">{{$item->name}}</h2>
          <span>Price: {{$item->price}} $</span>
          <hr class="sidebar-divider">
          <span class="pr-2"><small data-countdown="{{ $item->end_time }}"></small></span>
          <a href="{{route('items.show', $item->id )}}" class="btn btn-primary btn-sm">More &rarr;</a>
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

  </div>

  <!-- Pagination -->
  <ul class="pagination justify-content-center mb-4">
    <li class="page-item">
      <a class="page-link" href="#">&larr; Older</a>
    </li>
    <li class="page-item disabled">
      <a class="page-link" href="#">Newer &rarr;</a>
    </li>
  </ul>
  @endsection

  @section('categories')
  @foreach($categories as $category)
  <li>
    <a href="{{route('items.category', $category->id)}}">{{$category->name}}</a>
  </li>
  @endforeach
  @endsection
</x-auction-home>