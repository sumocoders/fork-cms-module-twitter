<?php

namespace Backend\Modules\Twitter\Installer;

use Backend\Core\Installer\ModuleInstaller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

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

        // Copy twitter.php
        $fs = new Filesystem();
        $fs->copy(dirname(__FILE__) . '/Twitter.php', PATH_LIBRARY . '/external/Twitter.php');

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
