<?php namespace Finnito\GroupsManagerModule\Form\Support;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\RelationshipFieldType\RelationshipFieldType;

/**
 * Class UsersHandler
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class UsersHandler
{

    /**
     * Hande the Options Handler
     * for the related field.
     *
     * @param RelationshipFieldType $field
     * @param UserRepositoryInterface $users
     * @return null|string
     */
    public function handle(RelationshipFieldType $field, UserRepositoryInterface $users)
    {
        dd($users);
    }
}
