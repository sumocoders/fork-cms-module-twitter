<?php

namespace Backend\Modules\Twitter\Actions;

use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;
use Backend\Core\Engine\Form as BackendForm;
use Backend\Core\Engine\Language as BL;
use Backend\Core\Engine\Model as BackendModel;

/**
 * This is the settings-action, it will display a form to set general twitter settings
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Settings extends BackendBaseActionEdit
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
        $this->display();
    }

    /**
     * Loads the settings form
     */
    private function loadForm()
    {
        $this->frm = new BackendForm('settings');

        $this->frm->addText('accounts', BackendModel::getModuleSetting($this->URL->getModule(), 'accounts'));
        $this->frm->addText('hashtags', BackendModel::getModuleSetting($this->URL->getModule(), 'hashtags'));
        $this->frm->addText('count', BackendModel::getModuleSetting($this->URL->getModule(), 'count'));

        // twitter settings
        $this->frm->addText(
            'twitter_consumer_key',
            BackendModel::getModuleSetting('Core', 'twitter_consumer_key', null)
        );
        $this->frm->addText(
            'twitter_consumer_secret',
            BackendModel::getModuleSetting('Core', 'twitter_consumer_secret', null)
        );
        $this->frm->addText('twitter_oauth_token', BackendModel::getModuleSetting('Core', 'twitter_oauth_token', null));
        $this->frm->addText(
            'twitter_oauth_token_secret',
            BackendModel::getModuleSetting('Core', 'twitter_oauth_token_secret', null)
        );
    }

    /**
     * Validates the settings form
     */
    private function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            if ($this->frm->getField('count')->isFilled()) {
                $this->frm->getField('count')->isInteger(BL::err('InvalidInteger'));
            }
            if ($this->frm->isCorrect()) {
                // set settings
                BackendModel::setModuleSetting(
                    $this->URL->getModule(),
                    'accounts',
                    $this->frm->getField('accounts')->getValue()
                );
                BackendModel::setModuleSetting(
                    $this->URL->getModule(),
                    'hashtags',
                    $this->frm->getField('hashtags')->getValue()
                );
                BackendModel::setModuleSetting(
                    $this->URL->getModule(),
                    'count',
                    $this->frm->getField('count')->getValue()
                );

                // twitter settings
                BackendModel::setModuleSetting(
                    'Core',
                    'twitter_consumer_key',
                    ($this->frm->getField('twitter_consumer_key')->isFilled()) ? $this->frm->getField(
                        'twitter_consumer_key'
                    )->getValue() : null
                );
                BackendModel::setModuleSetting(
                    'Core',
                    'twitter_consumer_secret',
                    ($this->frm->getField('twitter_consumer_secret')->isFilled()) ? $this->frm->getField(
                        'twitter_consumer_secret'
                    )->getValue() : null
                );
                BackendModel::setModuleSetting(
                    'Core',
                    'twitter_oauth_token',
                    ($this->frm->getField('twitter_oauth_token')->isFilled()) ? $this->frm->getField(
                        'twitter_oauth_token'
                    )->getValue() : null
                );
                BackendModel::setModuleSetting(
                    'Core',
                    'twitter_oauth_token_secret',
                    ($this->frm->getField('twitter_oauth_token_secret')->isFilled()) ? $this->frm->getField(
                        'twitter_oauth_token_secret'
                    )->getValue() : null
                );

                // trigger event
                BackendModel::triggerEvent($this->getModule(), 'after_saved_settings');

                // redirect to the settings page
                $this->redirect(BackendModel::createURLForAction('Settings') . '&report=saved');
            }
        }
    }
}
