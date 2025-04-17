<?php

declare(strict_types=1);

namespace Modules\Notify\Models\Panels\Policies;

use Modules\Cms\Contracts\PanelContract;
use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;
use Modules\Xot\Contracts\UserContract;

class _ModulePanelPolicy extends XotBasePanelPolicy
{
    /**
     * ---.
     */
    public function testSms(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    public function trySms(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    /**
     * --.
     */
    public function testMail(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    public function tryMail(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    /**
     * --.
     */
    public function trySendMail(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    /**
     * --.
     */
    public function TryAlert(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    /**
     * --.
     */
    public function trySendNotification(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }

    /**
     * --.
     */
    public function tryThemeNotification(UserContract $user, PanelContract $panel): bool
    {
        return true;
    }
}
