<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link"><i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i></a>
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
      <a class="nav-link" href="{{ route('commandes.index') }}">
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
      <a class="nav-link" href="{{ route('clients.index') }}">
        <span class="menu-title">Clients</span>
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
    <li class="nav-item">
      <a class="nav-link" href="{{ route('typefilter.index') }}">
        <span class="menu-title">Types des filtres</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('filters.index') }}">
        <span class="menu-title">Filtres</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('productfilters.index') }}">
        <span class="menu-title">Rolation produit/filtre</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>