<?php

declare(strict_types=1);

namespace Modules\Notify\Models\Panels;

use Modules\Cms\Models\Panels\XotBasePanel;

/**
 * Class _ModulePanel.
 */
class _ModulePanel extends XotBasePanel
{
    public function actions(): array
    {
        return [
            new Actions\TrySmsAction(),
            new Actions\TryMailAction(),
            new Actions\TrySendMailAction(),
            new Actions\TrySendNotificationAction(),
            // new Actions\TryThemeNotificationAction(),
            // new Actions\TryAlertAction(),
        ];
    }
}
