<div class="col-md-4">
  <div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form action="{{route('home')}}" method="GET">
        <div class="input-group">
          <input type="text" class="form-control bg-light small" placeholder="Search for..." aria-label="Search"
            aria-describedby="basic-addon2" name="searchText" value="">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <ul class="list-group list-group-flush">
      @foreach($categories as $category)
      <li class="list-group-item">
        <a href="{{route('items.category', $category->slug)}}">{{$category->name}}</a>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
      You can put anything you want inside of these side widgets. They are easy to use, and feature the new
      Bootstrap 4 card containers!
    </div>
  </div>
</div>