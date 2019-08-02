      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#role-permission" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account-key menu-icon"></i>
              <span class="menu-title">Roles/Permissions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="role-permission">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/roles"> Roles </a></li>
                <li class="nav-item"> <a class="nav-link" href="/permissions"> Permissions </a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/users">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/projects">
              <i class="mdi mdi-briefcase menu-icon"></i>
              <span class="menu-title">Projects</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
