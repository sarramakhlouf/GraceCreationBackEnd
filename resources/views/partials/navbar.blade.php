<style>
  button {
    outline: none;
    border: none;
    background-color: white;   Exemple de couleur de fond 
    /*color: white;  /* Couleur du texte */
    padding: 10px 20px;  /* Espacement interne */
    font-size: 16px;  /* Taille de police */
    cursor: pointer;  /* Change le curseur en main */
    border-radius: 5px;  /* Coins arrondis */
  }

</style>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ asset('assets/imgs/auth/Logo-Grace.svg') }}" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"> <img src="{{ asset('assets/imgs/auth/Logo-Grace.svg') }}" alt="Logo"></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="{{ asset('assets/imgs/auth/logo.png') }}" alt="Logo" class="h-12 w-auto lg:h-16 lg:text-[#FF2D20]">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{Auth::user()->name}}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-cached me-2 text-success"></i> Profile </a>
          <form action="{{ route('logout') }}" method="POST">
          @csrf
            <button type="submit"><i class="mdi mdi-logout me-2 text-primary"></i>Se déconnecter</button>
          </form>
        </div>
      </li>
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>