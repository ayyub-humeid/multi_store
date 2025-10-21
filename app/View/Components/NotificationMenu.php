<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications;
    public $NewNotificationsCount;//that wasn't read
    public function __construct()
    {
        $user = Auth::user();
        if($user){
            $this->notifications = $user->notifications()->take(10)->get();
            $this->NewNotificationsCount = $user->unreadNotifications()->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-menu');
    }
}