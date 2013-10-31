<?php

/**
 * Installer for the twitter module
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class TwitterInstaller extends ModuleInstaller
{
	/**
	 * Install the module
	 */
	public function install()
	{
		// add 'twitter' as a module
		$this->addModule('twitter');

		// import locale
		$this->importLocale(dirname(__FILE__) . '/data/locale.xml');

		// module rights
		$this->setModuleRights(1, 'twitter');

		// action rights
		$this->setActionRights(1, 'twitter', 'settings');

		// set navigation
		$navigationSettingsId = $this->setNavigation(null, 'Settings');
		$navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
		$this->setNavigation($navigationModulesId, 'Twitter', 'twitter/settings');

		// add extra's
		$this->insertExtra('twitter', 'widget', 'Tweets', 'tweets', null, 'N', 6000);
	}
}