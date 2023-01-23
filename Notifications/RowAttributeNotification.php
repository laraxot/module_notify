<?php

declare(strict_types=1);

namespace Modules\Notify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Notify\Data\SmsData;
use Modules\Xot\Contracts\ModelContactContract;

class RowAttributeNotification extends Notification {
    use Queueable;
    public ModelContactContract $row;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ModelContactContract $row) {
        $this->row = $row;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable) {
        return $this->row->getNotifyVia();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $message = (new MailMessage())
            ->subject($this->row->mail_subject)
            ->line('---')
            // non so se posso modificare questa riga senza creare errori in altre parti
            ->view('notify::emails.templates.ark.mail', ['html' => $this->row->mail_body]);

        $this->row->sendEmailCallback();

        return $message;
    }

    /**
     * Undocumented function.
     *
     * @param mixed $notifiable
     *
     * @return SmsData
     */
    public function toSms($notifiable) {
        return SmsData::from([
            'from' => $this->row->sms_from,
            'to' => $this->row->mobile_phone,
            'body' => $this->row->sms_body,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable) {
        dddx($notifiable);

        return [
        ];
    }
}