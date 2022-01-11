<x-admin-home>
  @section('content')
  <h1 class="h3 mb-4 text-gray-800">Categories Page</h1>

  <div class="mb-4 col-6">

    <!-- Add new category card -->
    <div class="card-body">
      <form method="POST" action="{{route('admin.add.category')}}">
        @csrf
        <div class="row">

          <!-- Name input -->
          <div class="col-10">
            <div class="form-outline">
              <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                placeholder="Category name" />
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <!-- Submit btn -->
          <div class="col-2">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Category list -->
    <div class="card">
      <div class="card-header">
        Category list
      </div>
      <div class="card-body">

        @foreach($categories as $category)

        <div class="row mb-2">
          <div class="col">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
              class="bi bi-caret-right-fill" viewBox="0 0 16 22">
              <path
                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
            </svg>
            {{$category->name}}
          </div>

          <div class="col">
            <form action="{{route('admin.delete.category', $category->id)}}" method="post">
              <input type="hidden" name="_method" value="delete" />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button class="btn btn-danger btn-circle btn-sm float-right" type="submit">X
              </button>
            </form>
          </div>
        </div>

        @endforeach

      </div>
    </div>

  </div>
  @endsection
</x-admin-home>