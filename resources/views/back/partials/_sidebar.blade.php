  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route(config('administrable.guard') . '.dashboard') }}" class="brand-link">
      <img src="{{ configuration('logo') }}" onerror="this.src='{{ config('administrable.logo_url') }}'" alt="{{ config('administrable.name')}}" class="brand-image img-circle" >

      {{-- <span class="brand-text font-weight-light">{{ config('app.last_name','vel') }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img  data-avatar="{{ get_guard('id') }}" src="{{ get_guard()->getFrontImageUrl() }}" class="img-circle elevation-2" alt="{{ get_guard()->full_name }}">
        </div>
        <div class="info">
          <a href="{{ back_route(config('administrable.guard') . '.profile', get_guard()) }}" class="d-block">{{ get_guard('pseudo') }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           {{-- insert sidebar links here --}}
            @php
            $countCommentNotifications = get_guard()->unreadNotifications->filter(fn($item) => $item->type ===
            config('administrable.modules.comment.back.notification'))->count();
            @endphp
            <li class="nav-item">
            <a href="{{ back_route('comment.index') }}" class="nav-link {{ set_active_link(back_route_path('comment.index')) }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Commentaires
                @if($countCommentNotifications)
                <span class="badge badge-success right">{{ $countCommentNotifications  }}</span>
                @endif
              </p>
            </a>
          </li>

            {{--  insert extensions links here  --}}

            <li class="nav-item">
            <a href="{{ back_route('user.index') }}" class="nav-link {{ set_active_link(back_route_path('user.index')) }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Utilisateurs
              </p>
            </a>
          </li>

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ set_active_link(back_route_path(config('administrable.guard') . '.index'), back_route_path(config('administrable.guard') . '.profile'), back_route_path(config('administrable.guard') . '.create')) }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ back_route(config('administrable.guard') . '.index') }}" class="nav-link {{ set_active_link(back_route_path(config('administrable.guard') . '.index')) }}">
                  <i class="far fa-th-list nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ back_route(config('administrable.guard') . '.profile', get_guard()) }}" class="nav-link {{ set_active_link(back_route_path(config('administrable.guard') . '.profile')) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mon profil</p>
                </a>
              </li>
                @if (get_guard()->can('create-' . config('administrable.guard')))
                    <li class="nav-item">
                        <a href="{{ back_route(config('administrable.guard') . '.create') }}" class="nav-link {{ set_active_link(back_route_path(config('administrable.guard') . '.create')) }}">
                            <i class="far fa-plus nav-icon"></i>
                            <p>Ajouter</p>
                        </a>
                    </li>
                @endif
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ back_route('page.index') }}" class="nav-link {{ set_active_link(back_route_path('page.index')) }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Pages
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ back_route('configuration.edit') }}" class="nav-link {{ set_active_link(back_route_path('configuration.edit')) }}">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Configuration
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
