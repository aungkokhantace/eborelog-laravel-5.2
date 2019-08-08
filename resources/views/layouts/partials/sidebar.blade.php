<?php
$role_id = App\Core\Utility::getCurrentUserRole();
$permissions = \App\Core\Utility::getPermissionByRoleId($role_id);
?>

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  @if(isset($permissions) && count($permissions)>0)
  <ul class="nav">
    <!-- start dashboard -->
    @if(in_array("home", $permissions))
    <li class="nav-item">
      <a class="nav-link" href="/home">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @endif
    <!-- end dashboard -->

    <!-- start roles/permissions -->
    @if(in_array("roles.index", $permissions) ||
    in_array("permissions.index", $permissions))
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#role-permission" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account-key menu-icon"></i>
        <span class="menu-title">Roles/Permissions</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="role-permission">
        <ul class="nav flex-column sub-menu">
          @if(in_array("roles.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/roles"> Roles </a></li>
          @endif
          @if(in_array("permissions.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/permissions"> Permissions </a></li>
          @endif
        </ul>
      </div>
    </li>
    @endif
    <!-- end roles/permissions -->

    <!-- start users -->
    @if(in_array("users.index", $permissions))
    <li class="nav-item">
      <a class="nav-link" href="/users">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    @endif
    <!-- end users -->

    <!-- start projects -->
    @if(in_array("projects.index", $permissions))
    <li class="nav-item">
      <a class="nav-link" href="/projects">
        <i class="mdi mdi-briefcase menu-icon"></i>
        <span class="menu-title">Projects</span>
      </a>
    </li>
    @endif
    <!-- end projects -->


    <!-- start setups for bore holes -->
    @if(in_array("nationalities.index", $permissions) ||
    in_array("drillers.index", $permissions) ||
    in_array("casings.index", $permissions) ||
    in_array("drilling_companies.index", $permissions) ||
    in_array("drilling_rigs.index", $permissions)
    )
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#setups-for-bh" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-altimeter menu-icon"></i>
        <span class="menu-title">Setup for Bore Holes</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="setups-for-bh">
        <ul class="nav flex-column sub-menu">
          <!-- start nationalities -->
          @if(in_array("nationalities.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/nationalities"> Nationalities </a></li>
          @endif
          <!-- end nationalities -->

          <!-- start drillers -->
          @if(in_array("drillers.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/drillers"> Drillers </a></li>
          @endif
          <!-- end drillers -->

          <!-- start casings -->
          @if(in_array("casings.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/casings"> Casings </a></li>
          @endif
          <!-- end casings -->

          <!-- start drilling_companies -->
          @if(in_array("drilling_companies.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/drilling_companies"> Drilling Companies </a></li>
          @endif
          <!-- end drilling_companies -->

          <!-- start drilling_rigs -->
          @if(in_array("drilling_rigs.index", $permissions))
          <li class="nav-item"> <a class="nav-link" href="/drilling_rigs"> Drilling Rigs </a></li>
          @endif
          <!-- end drilling_rigs -->
        </ul>
      </div>
    </li>
    @endif
    <!-- end setups for bore holes -->

    <!-- start config -->
    @if(in_array("config.edit", $permissions))
    <li class="nav-item">
      <a class="nav-link" href="/config">
        <i class="mdi mdi-cogs menu-icon"></i>
        <span class="menu-title">Config</span>
      </a>
    </li>
    @endif
    <!-- end config -->

  </ul>
  @endif
</nav>
<!-- partial -->
