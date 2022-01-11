<x-admin-home>
  @section('content')

  <div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Item information') }}</h6>
    </div>

    <div class="card-body">
      <form method="POST" action="{{route('items.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-4">

          <!-- Name input -->
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="name">Item name</label>
              <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" />
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
          </div>

          <!-- Price input -->
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="price">Item price</label>
              <input type="number" id="price" class="form-control @error('price') is-invalid @enderror" name="price" />
              @error('price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
          </div>

          <!-- Category input -->
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="category_id">Choose category</label>
              <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>

          </div>
        </div>

        <!-- Payment input -->
        <div class="form-outline row mb-4">
          <div class="col">
            <select class="browser-default custom-select form-control @error('payment') is-invalid @enderror"
              id="payment" name="payment">
              <option value="" selected>Select payment method:</option>
              <option value="card">Card</option>
              <option value="cash">Cash</option>
            </select>
            @error('payment')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- Delivery input -->
          <div class="col">
            <select class="browser-default custom-select form-control @error('delivery') is-invalid @enderror"
              id="delivery" name="delivery">
              <option value="" selected>Select delivery method:</option>
              <option value="regular">Regular</option>
              <option value="fast">Fast</option>
            </select>
            @error('delivery')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <!-- Description input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="description">Item description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4"
            name="description"></textarea>
          @error('description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Image url input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="image">Image url</label>
          <input class="form-control @error('image') is-invalid @enderror" id="image" type="text" name="image" />

          @error('image')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Submit btn -->
        <button type="submit" class="btn btn-primary">Add Item</button>
      </form>
    </div>
  </div>
  @endsection
</x-admin-home>