<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Entities\Report;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use PhpParser\Node\Expr\Cast\Bool_;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::VIEW_REPORTS);
    }

    /**
     * Determine whether the user can download the model.
     *
     * @param User $user
     * @return bool
     */
    public function download(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DOWNLOAD_REPORTS);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(Permissions::DELETE_REPORTS);
    }

}
