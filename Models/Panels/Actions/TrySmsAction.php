<?php
/**
 * --.
 */
declare(strict_types=1);

namespace Modules\Notify\Models\Panels\Actions;

// -------- services --------

use Illuminate\Support\Facades\Notification;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Models\Panels\Actions\XotBasePanelAction;
use Modules\Notify\Datas\NotificationData;
use Modules\Notify\Notifications\SampleNotification;

// -------- bases -----------

/**
 * Class TestAction.
 */
class TrySmsAction extends XotBasePanelAction {
    public bool $onItem = true;
    public string $icon = '<i class="fas fa-vial"></i>SMS';

    /**
     * @return mixed
     */
    public function handle() {
        $drivers = [
            'netfun' => 'netfun',
            'esendex' => 'esendex',
        ];
        $i = request('i');

        $driver = isset($drivers[$i]) ? $drivers[$i] : null;
        $view = app(GetViewAction::class)->execute();

        $view_params = [
            'view' => $view,
            'drivers' => $drivers,
            'driver' => $driver,
        ];

        return view($view, $view_params);
    }

    /**
     * @return mixed
     */
    public function postHandle() {
        $data = request()->all();
        $data['channels'] = [$data['driver']];
        $hows = NotificationData::from($data);
        Notification::send([$hows], new SampleNotification($data));
        echo '<h3>+Done</h3>';
    }
}
