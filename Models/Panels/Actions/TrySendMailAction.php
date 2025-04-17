<?php
/**
 * --.
 */
declare(strict_types=1);

namespace Modules\Notify\Models\Panels\Actions;

// -------- services --------

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Modules\Cms\Models\Panels\Actions\XotBasePanelAction;
use Modules\Notify\Emails\BeautyEmail;
use Modules\Notify\Notifications\Notify;
use Modules\Notify\Notifications\TestNotification;
use Modules\UI\Services\ThemeService;

// -------- bases -----------

/**
 * Class TrySendMailAction.
 */
class TrySendMailAction extends XotBasePanelAction {
    public bool $onItem = true;
    public string $icon = '<i class="fas fa-vial"></i>TrySendMail';

    /**
     * @return mixed
     */
    public function handle() {
        $options = [
            'DuoCircle' => 'duocircle',
            'Mailtrap' => 'mailtrap',
        ];

        $template_options = [
            'ark' => 'ark',
            'minty' => 'minty',
            'sunny' => 'sunny',
        ];
        $mail_mailers = config('mail.mailers');
        if (! is_array($mail_mailers)) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
        $mailer_options = array_keys($mail_mailers);
        $mailer_options = array_combine($mailer_options, $mailer_options);

        // $view = ThemeService::getView();
        $view = $this->panel->getView();

        $view_params = [
            'view' => $view,
            'options' => $options,
            'template_options' => $template_options,
            'mailer_options' => $mailer_options,
        ];

        return view($view, $view_params);
    }

    /**
     * ---.
     *
     * @return mixed
     */
    public function postHandle() {
        $data = request()->all();
        // $options['ssl'] = array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true);
        // dddx($data);
        // *
        try {
            Mail::mailer($data['mailer'])->raw($data['body'], function ($msg) use ($data) {
                $msg->to($data['to'])->subject($data['subject']);
            });
        } catch (\ErrorException $e) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        return 'done';
        // */
        // $view='notify::emails.welcome';
        /*
        $view = 'notify::emails.samples.ark';
        $test = (object) ['a' => 'b'];
        $users = [
            // new Notify('mail',['marco.sottana@gmail.com','marco76tv@hotmail.com']),
            new Notify('mail', 'marco.sottana@gmail.com'),
        ];

        Notification::send($users, new TestNotification($test));
        */
        /*
        $beautymail = app()->make(BeautyEmail::class);
        $view_params=$beautymail->getSettings();

        return view($view,$view_params);

        $beautymail->send($view, [],
            function(\Illuminate\Mail\Message $message) use($data){
                $res=$message
                    //->from($data['from'])
                    ->to($data['to'])
                    ->subject($data['subject']);
            }
        );
        */
        // */

        // echo '<h3>Done</h3>';
    }
}
