<?php

namespace App\Notifications;

use App\Models\Auth\User;
use App\Models\Tribe\Tribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAddedToTribe extends Notification
{
    use Queueable;

    /**
     * Tribe that the user is being invited to
     *
     * @var \App\Models\Tribe\Tribe
     */
    private $tribe;

    /**
     * User that is sending the invitation
     *
     * @var User
     */
    private $user;

    /**
     * A private UUID token for the invitation
     *
     * @var
     */
    private $token;

    /**
     * Create a new notification instance.
     *
     * @param \App\User|\Illuminate\Contracts\Auth\Authenticatable $user
     * @param \App\Models\Tribe\Tribe $tribe
     */
    public function __construct(User $user, Tribe $tribe, $token)
    {
        $this->tribe = $tribe;
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("{$this->user->username} has added you to their tribe {$this->tribe->name}")
                    ->markdown('emails.tribe.addUser', ['tribe' => $this->tribe, 'sendingUser' => $this->user, 'user' => $notifiable, 'token' => $this->token]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
