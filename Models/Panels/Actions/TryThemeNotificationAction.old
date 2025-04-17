<?php
/**
 * --.
 */
declare(strict_types=1);

namespace Modules\Notify\Models\Panels\Actions;

// -------- services --------

use Illuminate\Support\Facades\Notification;
use Modules\Cms\Models\Panels\Actions\XotBasePanelAction;
use Modules\Notify\Notifications\ThemeNotification;
use Modules\Xot\Datas\XotData;

// -------- bases -----------

/**
 * Class TrySendNotificationAction.
 */
class TryThemeNotificationAction extends XotBasePanelAction
{
    public bool $onItem = true;
    public string $icon = '<i class="fas fa-vial"></i> TryThemeNotification';

    /**
     * @return mixed
     */
    public function handle()
    {
        return $this->panel->view();
    }

    public function postHandle()
    {
        $xot = XotData::make();
        $email = request()->input('email', '');
        $profile_class = $xot->getProfileClass();

        $profiles = $profile_class::where('email', $email)->get();
        $view_params = [
            'gastone' => 'Nonna Papera',
        ];

        $res = Notification::send($profiles, new ThemeNotification('test', $view_params));
        echo '<h3>+Done<pre>'.print_r($res, true).'</pre></h3>';

        $profile = $profiles->first();
        $notifications = $profile->notifications()->get();
        echo '<table class="table table-bordered" border="1">
        <tr>
            <th>ID</th>
            <th>type</th>
            <th>data</th>
            <th>read at</th>
            <th>created </th>
            <th>updated </th>
        </tr>';
        foreach ($notifications as $n) {
            echo '<tr>
            <td>'.$n->id.'</td>
            <td>'.$n->type.'</td>
            <td><pre>'.print_r($n->data, true).'</pre></td>
            <td>'.$n->read_at.'</td>
            <td>'.$n->created_at.' '.$n->created_at.'</td>
            <td>'.$n->updated_at.' '.$n->updated_at.'</td>
            </tr>';
        }
        echo '</table>';
    }
}
