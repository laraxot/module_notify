<?php

declare(strict_types=1);

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Modules\Notify\Actions\BuildMailMessageAction;
use Modules\Notify\Datas\SmsData;
use Modules\Notify\Models\Notification as NotificationModel;
use Modules\Notify\Notifications\Channels\EsendexChannel;

class SampleNotification extends Notification
{
    use Queueable;

    public array $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     */
    public function via($notifiable): array
    {
        // return $notifiable->channels;
        $channels = ['database'];
        // $channels[]=EsendexChannel::class;
        // $channels[]='esendex'; //Driver [esendex] not supported.
        // $channels[]='array'; //Driver [array] not supported.
        // $channels[]='database'; //Driver [array] not supported.
        return $channels;
    }

    /* --WIP --
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage

    public function toEsendex($notifiable)
    {
        dddx($notifiable);
    }
    */

    /**
     * Undocumented function.
     *
     * @param mixed $notifiable
     *
     * @return SmsData
     */
    public function toSms($notifiable)
    {
        $res = SmsData::from([
            'from' => $this->data['from'],
            // 'to' => $notifiable->routeNotificationFor('sms'),
            'to' => $this->data['to'],
            'body' => $this->data['body'],
        ]);

        return $res;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   /*
        $view_params = $notifiable->toArray();
        if (isset($view_params['body']) && ! isset($view_params['body_html'])) {
            $view_params['body_html'] = $view_params['body'];
        }
        */
        $view_params = [];

        return app(BuildMailMessageAction::class)->execute('test', app(NotificationModel::class), $view_params);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        dddx('oo');

        return [
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return []; // $notifiable->toArray();
    }
}
