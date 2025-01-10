<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="../assets/images/faces/face1.jpg" alt="profile" />
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Chebaane Ahmed</span>
          <span class="text-secondary text-small">Project Manager</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('produits.index') }}">
        <span class="menu-title">Produits</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"href="{{ route('categories.index') }}">
        <span class="menu-title">Catégories</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('subcategories.index') }}">
        <span class="menu-title">Sous-Catégories</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('slides.index') }}">
        <span class="menu-title">Slides</span>
        <i class="mdi mdi-contacts menu-icon"></i>
      </a>   
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('orders.index') }}">
        <span class="menu-title">Commandes</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>  
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('users.index') }}">
        <span class="menu-title">Users</span>
        <i class="mdi mdi-lock menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admins.index') }}">
        <span class="menu-title">Admins</span>
        <i class="mdi mdi-lock menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('depots.index') }}">
        <span class="menu-title">Dépôts</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('inventories.index') }}">
        <span class="menu-title">Inventaires</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>