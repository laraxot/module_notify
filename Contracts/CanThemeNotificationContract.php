<?php

declare(strict_types=1);

namespace Modules\Notify\Contracts;

use Illuminate\Database\Eloquent\Model;
use Modules\Notify\Datas\NotificationData;

interface CanThemeNotificationContract
{
    public function getNotificationData(string $name, array $view_params = []): NotificationData;

    public function getModel(): Model;

    /**
     * @return mixed|null
     */
    public function sendEmailCallback();
}
