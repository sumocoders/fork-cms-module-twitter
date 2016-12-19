<?php

namespace Frontend\Modules\Twitter\Widgets;

require_once PATH_LIBRARY . '/external/Twitter.php';

use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Modules\Twitter\Engine\Model;
use TijsVerkoyen\Twitter\Twitter;

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
        $consumer_key = $this->get('fork.settings')->get('Core', 'twitter_consumer_key', null);
        $consumer_secret = $this->get('fork.settings')->get('Core', 'twitter_consumer_secret', null);
        $oauth_token = $this->get('fork.settings')->get('Core', 'twitter_oauth_token', null);
        $oauth_token_secret = $this->get('fork.settings')->get('Core', 'twitter_oauth_token_secret', null);

      // init vars
      $accountsString = $this->get('fork.settings')->get('Twitter', 'accounts', '');
        $accounts = $accountsString == '' ? array() : explode(',', $accountsString);
        $hashtagsString = $this->get('fork.settings')->get('Twitter', 'hashtags', '');
        $hashtags = $hashtagsString == '' ? array() : explode(',', $hashtagsString);

      // create instance & set some properties
      $twitter = new Twitter($consumer_key, $consumer_secret);
        $twitter->setOAuthToken($oauth_token);
        $twitter->setOAuthTokenSecret($oauth_token_secret);

        $tweets =  array();

        $pool = $this->get('cache.pool');
        $item = $pool->getItem('tweets');
        if (!is_null($item->get())) {
            $tweets = $item->get();
        } else {
            $tweets =  Model::getLastTweets($this->get('fork.settings')->get('Twitter', 'count') ?: 10, $twitter, $accounts, $hashtags);
            $item->set($tweets);
            $item->expiresAfter(600); //cache for 10 minutes
        $pool->save($item);
        }

        // assign data
        $this->tpl->assign(
            'widgetTwitterTweets',
            $tweets
        );
    }
}
