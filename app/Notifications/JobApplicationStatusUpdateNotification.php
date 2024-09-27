<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplicationStatusUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $job_title;
    protected $name;
    protected $status;
    protected $company;

    /**
     * Create a new notification instance.
     */
    public function __construct($mailObj)
    {
        $this->name = $mailObj['name'];
        $this->job_title = $mailObj['job_title'];
        $this->status = $mailObj['status'];
        $this->company = $mailObj['company'];
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
    public function toMail(): MailMessage
    {

        $statusMessages = [
            'Interviewing' => 'Invitation for interview',
            'Shortlisted' => 'You have been Shortlisted',
            'Rejected' => 'We thank you for your interest in the above position. We have carefully reviewed your application and qualifications, and while we were impressed with your skills and experience, we have decided to move forward with other candidates whose qualifications more closely align with our current needs.',
            'Offered' => 'You have been offered This Job',
            'In-Review' => 'Aplication In review',
        ];


        return (new MailMessage)
            ->greeting("Dear {$this->name},")
            ->subject('Update on Job Application TEST')
            ->line("Update on Job Application (**{$this->job_title}** at **{$this->company}**")
            // ->line("Thank you for your interest on the above job description in our company .")
            ->line("{$statusMessages[$this->status]}");
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
