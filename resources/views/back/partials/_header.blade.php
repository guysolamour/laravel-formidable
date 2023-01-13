<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link  text-primxary btn btn-info text-white btn-sm" target="_blank">Voir le site</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     {{-- Insert Mailbox Link --}}
     {{-- Insert Notification Link --}}
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="nav-icon far fa-user"></i>
          {{--<i class="far fa-bell"></i>--}}
{{--            <img src="{{ get_guard()->avatar }}" class="user-image" alt="{{ get_guard()->pseudo }}">--}}
            {{--<span class="hidden-xs">{{ Str::ucfirst(get_guard()->full_name) }} <i class="right fas fa-angle-down"></i></span>--}}
          {{--<span class="badge badge-warning navbar-badge">15</span>--}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="p-2 text-center">
                <p class="user-header">
                    <img data-avatar="{{ get_guard('id') }}" src="{{ get_guard()->getFrontImageUrl() }}" class="img-circle img-fluid" alt="{{ get_guard()->pseudo }} Image" style='width: 100px;'>
                </p>
                <p class="pb-2">
                    {{ get_guard()->full_name }} <br> <small>{{ get_guard()->role }}</small>
                </p>
                <!-- Menu Footer-->
                <p class="d-flex justify-content-between">
                    <a href="{{ back_route('admin.profile', get_guard()) }}" class="btn btn-default btn-flat">Profil</a>

                     <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();document.getElementById('admin-logout-form').submit();">Déconnexion</a>
                </p>
                 <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                    @honeypot
                </form>
            </div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
