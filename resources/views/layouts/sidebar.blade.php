<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link text-center">
    <span class="brand-text font-weight-light">My Cafeteria</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link">
            <i class="nav-icon fas fa-coffee"></i><p>Products</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('orders.index') }}" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i><p>Orders</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i><p>Users</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
