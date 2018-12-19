<?php namespace Finnito\GroupManagerModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class GroupManagerModule
 *
 * @link          https://finnito.nz/
 * @author        Finn LeSueur <finn.lesueur@gmail.com>
 */
class GroupManagerModule extends Module
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
