<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SystemeNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    
     public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'url' => $this->details['url'],
            'title' => $this->details['title'],
            'user' => $this->details['user'],      // Ajout de l'utilisateur
            'date' => $this->details['date'],  // Ajout de l'action
            'action' => $this->details['action'], // Ajout du message, si vous l'avez ajouté
         
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'title' => $this->details['title'],
    //         'message' => $this->details['message'] ?? '',
    //         'url' => $this->details['url'],
    //         'sound' => $this->details['sound'] ?? 'son1.wav' // Transmission du son
    //     ]);
    // }
}
