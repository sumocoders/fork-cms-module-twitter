<?php

/**
 * This is the configuration-object for the twitter module
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class BackendTwitterConfig extends BackendBaseConfig
{
	/**
	 * The default action
	 *
	 * @var	string
	 */
	protected $defaultAction = 'settings';

	/**
	 * The disabled actions
	 *
	 * @var	array
	 */
	protected $disabledActions = array();
}
