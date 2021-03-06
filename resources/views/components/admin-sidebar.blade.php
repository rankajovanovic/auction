<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Menu<sup></sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="{{route('home')}}">
      <i class="fas fa-home"></i>
      <span>Home</span></a>
  </li>

  @if( auth()->user()->userHasRole('Admin') )
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    admin mode
  </div>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('admin')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Admin Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>DB Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Components:</h6>
        <a class="collapse-item" href="{{route('admin.users')}}">Users</a>
        <a class="collapse-item" href="{{route('admin.items')}}">Items</a>
        <a class="collapse-item" href="{{route('admin.categories')}}">Categories</a>
        <a class="collapse-item" href="{{route('admin.bids')}}">Bids</a>
        <a class="collapse-item" href="{{route('admin.roles')}}">Roles</a>
      </div>
    </div>
  </li>
  @endif

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>

  <!-- Nav Item - Profile Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true"
      aria-controls="collapseProfile">
      <i class="fas fa-fw fa-user"></i>
      <span>Profile</span>
    </a>
    <div id="collapseProfile" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Change your info:</h6>
        <a class="collapse-item" href="{{ route('users.profile', auth()->user()->id)}}">Profile</a>
        <a class="collapse-item" href="{{ route('users.settings', auth()->user()->id)}}">Settings</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Items Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-box-open"></i>
      <span>Items</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Item Utilities:</h6>
        <a class="collapse-item" href="{{route('items.create')}}">Add Item</a>
        <a class="collapse-item" href="{{route('items.my-items')}}">Active items</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCart" aria-expanded="true"
      aria-controls="collapseCart">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Cart</span>
    </a>
    <div id="collapseCart" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Cart Utilities:</h6>
        <a class="collapse-item" href="{{ route('items.selled') }}">Selled items</a>
        <a class="collapse-item" href="{{ route('items.purchased') }}">Purchased items</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="{{route('bids')}}">
      <i class="fas fa-fw fa-comment-dollar"></i>
      <span>Bids</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

  <!-- <div class="sidebar-heading">
    Addons
  </div> -->


</ul>