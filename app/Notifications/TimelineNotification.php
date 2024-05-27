<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use DateTime;
use DateInterval;

class TimelineNotification extends Notification
{
    use Queueable;

    // const GREEN = 259200;
    // const YELLOW = 86400;
    // const RED = 10800;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
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
                //
            ];
    }

    /**
     * Set notification determined by proximity
     *
     * @return
     */
    public function generateNotification(DateInterval $date): string
    {
        $timestamps = $this->intervalToSeconds($date);
        switch ($timestamps) {
            case $timestamps >= 259200:
                return 'Green Display';
                break;

            case $timestamps >= 86400:
                return 'Yellow Display';
                break;

            case $timestamps <= 10800:
                return 'Red Display';
                break;
        }
    }

    public function intervalToSeconds(DateInterval $interval)
    {
        $setDate = new DateTime('@0');
        $setDate->add($interval);
        return $setDate->getTimestamp();
    }
}
