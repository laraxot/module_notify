<?php

declare(strict_types=1);

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Modules\Notify\Actions\BuildMailMessageAction;
use Modules\Notify\Contracts\CanThemeNotificationContract;
use Modules\Notify\Datas\SmsData;

class ThemeNotification extends Notification implements ShouldQueue
{ 
    use Queueable;
    public array $view_params;
    public string $name;
    public array $attachments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, array $view_params)
    {
        $this->name = $name;
        $this->view_params = $view_params;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param CanThemeNotificationContract $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        $channels = $notifiable
            ->getNotificationData($this->name, $this->view_params)
            ->channels;

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param CanThemeNotificationContract $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $attachments = $notifiable
            ->getNotificationData($this->name, $this->view_params)
            ->attachments;

        $mail_message = app(BuildMailMessageAction::class)
             ->execute($this->name, $notifiable->getModel(), $this->view_params, $attachments);


        $notifiable->sendEmailCallback();

        return $mail_message;
    }

    // public function toEssendex($notifiable)
    // {
    //    dddx($notifiable);
    // }

    /**
     * Undocumented function.
     *
     * @param CanThemeNotificationContract $notifiable
     *
     * @return SmsData
     */
    public function toSms($notifiable)
    {
        return $notifiable
            ->getNotificationData($this->name, $this->view_params)
            ->getSmsData();
        /*
        return SmsData::from([
            'from' => $this->from,
            'to' => $notifiable->routeNotificationFor('mobile'),
            'body' => $this->html,
        ]);
        */

        // $notifiable->sendSmsCallback()
    }

    /**
     * Get the array representation of the notification.
     *
     * @param CanThemeNotificationContract $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        $res = $this->view_params;
        $res['_name'] = $this->name;

        return $res;
    }
}
