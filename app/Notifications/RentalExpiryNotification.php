<?php

namespace App\Notifications;

use App\Models\AssetAssignment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalExpiryNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public AssetAssignment $assignment)
    {
        //
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
        $returnedDate = Carbon::parse($this->assignment->returned_date)->format('F j, Y');

        return (new MailMessage)
            ->subject('Rental Expiry Reminder')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line("This is a reminder that your rented asset is due to be returned on **{$returnedDate}**.")
            ->line('Please ensure the asset is returned on or before the due date to avoid any penalties or service issues.')
            ->action('View My Rentals', url('/rentals')) // Update this URL as needed
            ->line('Thank you for using our asset rental service!');
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
