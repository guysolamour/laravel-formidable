       <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            @php
                $unreadNotifications = get_guard()->unreadNotifications;
            @endphp
            <i class="far fa-bell"></i>
            @if($unreadNotifications->count())
                <span class="badge badge-danger navbar-badge">{{ $unreadNotifications->count() }}</span>
            @endif

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @forelse($unreadNotifications as $notification)
                    @if($notification->type === 'App\Notifications\Back\CommentNotification')
                    <a href="{{ back_route('comment.show', $notification->data['comment']['id']) }}" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <div class="media-body">
                                <p class="text-sm">
                                    Un commentaire vient d'être déposé sur le site,
                                    par <b>{{ $notification->data['commenter_name'] }}</b>
                                    joignable à l'adresse <b>{{ $notification->data['commenter_email'] }}</b>.
                                </p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <a href="{{ back_route('notification.markasread') }}" class="dropdown-item dropdown-footer">Tous marquer comme lues</a>
                @empty
                <a href="#" class="dropdown-item">Pas de notifications pour l'instant</a>
                @endforelse
            </div>
        </li>
