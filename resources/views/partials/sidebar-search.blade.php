<div class="card my-4">
  <h5 class="card-header">Search</h5>
  <div class="card-body">
    <form action="{{route('search')}}" method="GET">
      <div class="input-group">
        <input type="text" class="form-control bg-light small" placeholder="Search for..." aria-label="Search"
          aria-describedby="basic-addon2" name="searchText" value="">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Go!
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>