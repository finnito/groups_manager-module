<?php namespace Finnito\GroupsManagerModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class GroupsManagerModule
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class GroupsManagerModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'users';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'groups' => [],
    ];
}
