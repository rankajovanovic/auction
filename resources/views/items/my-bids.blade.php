<x-admin-home>
  @section('content')
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">My bids</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="bidsTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Bid Price</th>
              <th>Image</th>
              <th>End time</th>
              <th>Del</th>
            </tr>
          </thead>
          <tbody>
            @foreach($bids as $bid)
            <tr>
              <td>
                <a href="{{route('items.show', [$bid->item->id] )}}">{{$bid->item->name}}</a>
              </td>
              <td>{{$bid->price}} $</td>
              <td>
                <img src="{{$bid->item->image}}" alt="" style="width: 70px;">
              </td>
              <td data-countdown="{{ $bid->item->end_time }}"></td>
              <td>
                <form action="{{route('bids.delete', $bid->id) }}" method="post">
                  <input type="hidden" name="_method" value="delete" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button class="btn" type="submit">
                    <i class="fas fa-2x	 fa-trash-alt text-danger"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection
</x-admin-home>