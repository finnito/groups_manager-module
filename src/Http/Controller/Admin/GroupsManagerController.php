<?php namespace Finnito\GroupsManagerModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;

/**
 * Class GroupsManagerController
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class GroupsManagerController extends AdminController
{

    /**
     * Render the Group Manager view.
     *
     * @param RoleRepositoryInterface $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RoleRepositoryInterface $roles)
    {
        $groups = $roles
            ->newQuery()
            ->whereNotIn("slug", ["admin", "guest", "user"])
            ->get();
        return $this->view->make(
            "finnito.module.groups_manager::index",
            [
                "groups" => $groups,
            ]
        );
    }
}
