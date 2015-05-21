<?php

namespace Frontend\Modules\Twitter;

use Frontend\Core\Engine\Base\Config as FrontendBaseConfig;

/**
 * This is the configuration-object
 *
 * @author Jonas <jonas@sumocoders.be>
 */
class Config extends FrontendBaseConfig
{
    /**
     * The default action
     *
     * @var    string
     */
    protected $defaultAction = 'Tweets';

    /**
     * The disabled actions
     *
     * @var    array
     */
    protected $disabledActions = array();
}
