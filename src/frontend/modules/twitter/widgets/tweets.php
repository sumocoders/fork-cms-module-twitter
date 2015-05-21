<?php

namespace Frontend\Modules\Twitter\Widgets;

use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Modules\Twitter\Engine\Model;

/**
 * This is the tweets widget.
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 * @author Toon Daelman <toon@sumocoders.be>
 */
class Tweets extends FrontendBaseWidget
{
    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();
        $this->loadTemplate();
        try {
            $this->parse();
        } catch (\Exception $e) {
            // in debugmode we want to see the exceptions
            if (SPOON_DEBUG) {
                throw $e;
            } // stop
            else {
                return false;
            }
        }
    }

    /**
     * Parse into template
     */
    private function parse()
    {
        // We'll cache the tweets
        $this->tpl->cache(FRONTEND_LANGUAGE . '_twitterWidgetTweetsCache', (10 * 60 * 60));

        if (!$this->tpl->isCached(FRONTEND_LANGUAGE . '_twitterWidgetTweetsCache')) {
            // assign data
            $this->tpl->assign(
                'widgetTwitterTweets',
                Model::getLastTweets(FrontendModel::getModuleSetting('Twitter', 'count') ?: 10)
            );
        }
    }
}
