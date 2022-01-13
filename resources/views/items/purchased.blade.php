<x-admin-home>
  @section('content')
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">My purchased items</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Purchased time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td> <a href="{{route('items.show', [$item->id] )}}">{{$item->name}}</a>
              </td>
              <td>{{$item->bid_price}} $</td>
              <td>{{$item->end_time}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
  @endsection
</x-admin-home>