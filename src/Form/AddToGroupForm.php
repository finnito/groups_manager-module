<?php namespace Finnito\GroupsManagerModule\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Auth\Guard;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\Streams\Platform\Message\MessageBag;

/**
 * Class AddToGroupForm
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class AddToGroupForm
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
            $bag->error("Sorry, the role you asked for cannot be found.");
            redirect(url()->previous())->send();
        }

        if (!$member = $users->find($values["user"])) {
            $bag->error("Sorry, the user you asked to add cannot be found.");
            redirect(url()->previous())->send();
        }

        if ($member->hasRole($values["role"])) {
            $bag->error("Sorry, the user you asked to add already belongs to that group.");
            redirect(url()->previous())->send();
        }


        $member->attachRole($role);
        $users->save($member);
        $bag->success("{$member->display_name} added to {$role->name}!");
        redirect(url()->previous())->send();
    }
}
