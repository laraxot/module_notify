<?php
/**
 * --.
 */
declare(strict_types=1);

namespace Modules\Notify\Models\Panels\Actions;

// -------- services --------

use Exception;
use ErrorException;
use Illuminate\Support\Facades\Mail;
use Modules\UI\Services\ThemeService;
use Modules\Notify\Emails\BeautyEmail;
use Modules\Notify\Notifications\Notify;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Notifications\HtmlNotification;
use Modules\Notify\Notifications\TestNotification;
use Modules\Cms\Models\Panels\Actions\XotBasePanelAction;

// -------- bases -----------

/**
 * Class TrySendNotificationAction.
 */
class TrySendNotificationAction extends XotBasePanelAction {
    public bool $onItem = true;
    public string $icon = '<i class="fas fa-vial"></i>TrySendNotification';

    /**
     * @return mixed
     */
    public function handle() {
        
        Notification::route('mail', [
            'davidecavallini1987@gmail.com' => 'Davide Cavallini',
        ])->notify(new HtmlNotification('hello@example.com','Soggetto a caso','<h1>Ciao</h1>'));

        return 'done';
    }
}
