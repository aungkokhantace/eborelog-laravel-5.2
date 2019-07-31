<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo" href="/home"><img src="/images/fosta-logo.png" alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="/home"><img src="/template/images/logo-mini.svg" alt="logo" /></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav navbar-nav-right">

      <!-- user is not logged in  -->
      @if (Auth::guest())
      <li class="nav-item">
        <a class="nav-link" href="/login"> Login </a>
      </li>
      @if(Route::has('register'))
      <li class="nav-item">
        <a class="nav-link" href="/register"> Register </a>
      </li>
      @endif
      <!-- user is not logged in  -->
      <!-- user is logged in -->
      @else
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <span class="nav-profile-name">{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <!-- profile -->
          <a class="dropdown-item" href="/profile">Profile</a>
          <!-- logout -->
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
      </li>
      @endif
      <!-- user is logged in -->
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<!-- partial -->

<div class="container-fluid page-body-wrapper">
