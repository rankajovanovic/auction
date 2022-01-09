<x-admin-home>
  @section('content')
  <h1 class="h3 mb-4 text-gray-800">Admin Page</h1>
  <p>Role name: </p>

  @foreach( auth()->user()->roles as $role)
  {{$role->name}} <br>
  @endforeach
  @endsection
</x-admin-home>