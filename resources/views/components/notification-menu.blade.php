<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if($NewNotificationsCount)
        <span class="badge badge-warning navbar-badge">{{$NewNotificationsCount}}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{$NewNotificationsCount}} Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>

        @foreach ($notifications as $notification )

        <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="dropdown-item @if($notification->unread()) text-bold @endif ">
            <i class="{{$notification->data['icon']}} mr-2"></i> {{$notification->data['body']}}
            <span class="float-right text-muted text-sm">{{$notification->created_at}}</span>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach


        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
