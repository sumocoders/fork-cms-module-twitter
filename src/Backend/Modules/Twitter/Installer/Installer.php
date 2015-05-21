<?php

namespace Backend\Modules\Twitter\Installer;

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the twitter module
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Installer extends ModuleInstaller
{
    /**
     * Install the module
     */
    public function install()
    {
        // add 'twitter' as a module
        $this->addModule('Twitter', 'The twitter module.');

        // import locale
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        // module rights
        $this->setModuleRights(1, $this->getModule());

        // action rights
        $this->setActionRights(1, $this->getModule(), 'Settings');

        // set navigation
        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, $this->getModule(), 'twitter/settings');

        // add extra's
        $this->insertExtra($this->getModule(), 'widget', 'Tweets', 'Tweets', null, 'N', 6000);
    }
}
