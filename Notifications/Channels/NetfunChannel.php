<?php


namespace Modules\Notify\Notifications\Channels;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Modules\Notify\Actions\NetfunSendAction;

class NetfunChannel {

    public function __construct(){
       
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)    {
        
        $message = $notification->toSms($notifiable);
        // Send notification to the $notifiable instance...
        $data=app(NetfunSendAction::class)->execute($message);
        
        if($notifiable instanceof Model){
            $data['sms_sent_at']=now();
            $data['sms_count']=$notifiable->sms_count +1;
            $notifiable->update($data);
        }
        
    }
}