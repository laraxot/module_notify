<?php

declare(strict_types=1);

namespace Modules\Notify\Contracts;

use Illuminate\Database\Eloquent\Model;
use Modules\Notify\Datas\NotificationData;

interface CanThemeNotificationContract
{
    public function getNotificationData(string $name): NotificationData;

    public function getModel(): Model;
}