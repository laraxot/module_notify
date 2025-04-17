<?php
namespace Modules\Notify\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\User as User;
use Modules\Notify\Models\Panels\Policies\ContactPanelPolicy as Post; 

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class ContactPanelPolicy extends XotBasePanelPolicy {
}
