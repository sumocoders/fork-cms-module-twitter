<?php

namespace Backend\Modules\Twitter;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the twitter module
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Config extends BackendBaseConfig
{
    /**
     * The default action
     *
     * @var    string
     */
    protected $defaultAction = 'Settings';

    /**
     * The disabled actions
     *
     * @var    array
     */
    protected $disabledActions = array();
}
