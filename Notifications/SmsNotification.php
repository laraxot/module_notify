<?php

declare(strict_types=1);

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Modules\Notify\Datas\SmsData;

class SmsNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public string $subject;
    public string $html;
    public string $from;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $from, string $subject, string $html)
    {
        $this->from = $from;
        $this->subject = $subject;
        $this->html = $html;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['esendex'];
    }

    /**
     * Undocumented function.
     *
     * @param object $notifiable
     *
     * @return SmsData
     */
    public function toSms($notifiable)
    {
        if (! method_exists($notifiable, 'routeNotificationFor')) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        return SmsData::from([
            'from' => $this->from,
            'to' => $notifiable->routeNotificationFor('sms'),
            'body' => $this->html,
        ]);
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
        dddx($notifiable);

        return [
        ];
    }
}
