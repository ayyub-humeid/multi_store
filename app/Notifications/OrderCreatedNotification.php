<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $address = $this->order->billingAddress;
        return (new MailMessage)
            ->subject('New Order Created.'. $this->order->number)
            ->greeting("Hello {$notifiable->name},")
            ->line("A new order created by {$address->name} from {$address->country_name}.")
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }
     public function toDatabase(object $notifiable)
    {
        $address = $this->order->billingAddress;

      return [
        'body'=> "A new order created by {$address->name} from {$address->country_name}.",
        'icon'=> 'fas fa-file',
        'url'=> '/dashboard',
        'id'=> $this->order->id
      ];
    }
     public function toBroadcast(object $notifiable)
    {
        $address = $this->order->billingAddress;

      return new BroadcastMessage( [
        'body'=> "A new order created by {$address->name} from {$address->country_name}.",
        'icon'=> 'fas fa-file',
        'url'=> '/dashboard',
        'id'=> $this->order->id
      ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
