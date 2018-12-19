<?php namespace Finnito\GroupManagerModule\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Auth\Guard;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\Streams\Platform\Message\MessageBag;

/**
 * Class RemoveFromGroupForm
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class RemoveFromGroupForm
{

    /**
     * Handle the form
     *
     * @param FormBuilder $builder
     * @param Guard $auth
     * @param UserRepositoryInterface $users
     * @param RoleRepositoryInterface $roles
     * @param MessageBag $bag
     * @return null
     */
    public function handle(
        FormBuilder $builder,
        Guard $auth,
        UserRepositoryInterface $users,
        RoleRepositoryInterface $roles,
        MessageBag $bag
    ) {
        if (!$user = $auth->user()) {
            $bag->error("Sorry, you need to be logged in to perform this action.");
            redirect(url()->previous())->send();
        }

        if (!$user->hasAnyRole(["committee", "admin"])) {
            $bag->error("Sorry, you to have the Committee or Admin role to perform this action.");
            redirect(url()->previous())->send();
        }

        $values = $builder->getFormValues();

        if (!$role = $roles->findBy("slug", $values["role"])) {
            $bag->error("Sorry, the role you asked to remove cannot be found.");
            redirect(url()->previous())->send();
        }

        if (!$member = $users->findBy("username", $values["username"])) {
            $bag->error("Sorry, the user you asked to remove cannot be found.");
            redirect(url()->previous())->send();
        }

        if (!$member->hasRole($values["role"])) {
            $bag->error("Sorry, the user you asked to remove does not belong to that group.");
            redirect(url()->previous())->send();
        }


        $member->detachRole($role);
        $users->save($member);
        $bag->success("{$user->display_name} removed from {$role->name}!");
        redirect(url()->previous())->send();
    }
}
