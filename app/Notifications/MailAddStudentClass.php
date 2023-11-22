<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailAddStudentClass extends Notification
{
    use Queueable;

    protected $classroomId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($classroomId)
    {
        $this->classroomId = $classroomId;
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
        $url = url('admin/userclass/'. $this->classroomId);
        return (new MailMessage)
                    ->line('Chào mừng bạn tham gia lớp học')
                    ->action('Notification Action', url($url))
                    ->line('Cùng nhau học tập và phát triển');
        // return (new MailMessage)->view(
        //     'screens.backend.mail.add-student', ['classroomId' => $this->classroomId]
        // );
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
