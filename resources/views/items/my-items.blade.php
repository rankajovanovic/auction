<x-admin-home>
  @section('content')
  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">My items</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Image</th>
              <th>Category</th>
              <th>Number of bids</th>
              <th>Start date</th>
              <th>End time</th>
              <th>Del</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td>
                <a href="{{route('items.show', $item->slug )}}">{{$item->name}}</a>
              </td>
              <td>{{$item->price}} $</td>
              <td>
                <img src="{{$item->image}}" alt="" style="width: 70px;">
              </td>
              <td>{{$item->category ? $item->category->name : 'Uncategorized'}}</td>
              <td>{{count($item->bids)}}</td>
              <td>{{$item->created_at->format('Y-m-d')}}</td>
              <td data-countdown="{{ $item->end_time }}"></td>
              <td>
                <form action="{{route('items.delete', $item->id)}}" method="post">
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