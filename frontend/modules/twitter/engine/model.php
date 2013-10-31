<?php

use \TijsVerkoyen\Twitter\Twitter;

/**
 * In this file we store all generic functions that we will be using in the twitter module
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class FrontendTwitterModel
{
	/**
	 * Get the latest tweets
	 *
	 * @param int[optional] $limit The number of tweets to get.
	 * @return array
	 */
	public static function getLastTweets($limit = 10)
	{
		$consumer_key = BackendModel::getModuleSetting('core', 'twitter_consumer_key', null);
		$consumer_secret = BackendModel::getModuleSetting('core', 'twitter_consumer_secret', null);
		$oauth_token = BackendModel::getModuleSetting('core', 'twitter_oauth_token', null);
		$oauth_token_secret = BackendModel::getModuleSetting('core', 'twitter_oauth_token_secret', null);

		// create instance & set some properties
		$twitter = new Twitter($consumer_key, $consumer_secret);
		$twitter->setOAuthToken($oauth_token);
		$twitter->setOAuthTokenSecret($oauth_token_secret);

		// init vars
		$accountsString = FrontendModel::getModuleSetting('twitter', 'accounts', '');
		$accounts = $accountsString == '' ? array() : explode(',', $accountsString);
		$hashtagsString = FrontendModel::getModuleSetting('twitter', 'hashtags', '');
		$hashtags = $hashtagsString == '' ? array() : explode(',', $hashtagsString);

		$tweetsArray = array();
		foreach($accounts as $account)
		{
            try {
                // get tweets
                $tweets = $twitter->statusesUserTimeline(null, $account, null, 5000, null, null, true);

                // filter tweets on hashtags
                foreach($tweets as $tweet)
                {
                    // check for hashtags
                    foreach($hashtags as $hashtag)
                    {
                        if(FrontendTwitterModel::in_array_r($hashtag, $tweet['entities']['hashtags'], true)) $tweetsArray[] = FrontendTwitterModel::parseTweet($tweet);
                    }
                    // show all tweets when no hashtags in settings
                    if(empty($hashtags)) $tweetsArray[] = FrontendTwitterModel::parseTweet($tweet);
                }
            }
            catch(\TijsVerkoyen\Twitter\Exception $e) {
                if(SPOON_DEBUG) throw $e;
            }
		}

		// sort tweets
		usort($tweetsArray, array('FrontendTwitterModel', 'sortTweets'));


		// limit tweets
		return array_slice($tweetsArray, 0, $limit);;
	}

	/**
	 * In array recursive
	 *
	 * @param      $needle
	 * @param      $haystack
	 * @param bool $strict
	 * @return bool
	 */
	private static function in_array_r($needle, $haystack, $strict = false)
	{
		$needle = strtolower($needle);
		foreach ($haystack as $item)
		{
			if(!is_array($item)) $item = strtolower($item);
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && FrontendTwitterModel::in_array_r($needle, $item, $strict)))
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Parse a tweet
	 *
	 * @param array $tweet
	 * @return array
	 */
	private static function parseTweet($tweet)
	{
		// add UNIX timestamp
		$tweet['createdAtTimestamp'] = strtotime($tweet['created_at']);

		// cleanup text: include links to other twitter people, detect links
		// and make them clickable, include links to other hashtags
		$tweet['htmlText'] = SpoonFilter::replaceURLsWithAnchors($tweet['text']);
		$tweet['htmlText'] = preg_replace(
			'/@([a-z0-9-_]+)+/i',
			'<a rel="nofollow" href="http://twitter.com/$1">@$1</a>',
			$tweet['htmlText']
		);
		$tweet['htmlText'] = preg_replace(
			'/#([a-z0-9-_]+)+/i',
			'<a rel="tag" href="http://twitter.com/search/%23$1">#$1</a>',
			$tweet['htmlText']
		);

		return $tweet;
	}

	/**
	 * Helper function for sorting tweets
	 *
	 * @param	$a
	 * @param	$b
	 * @return int
	 */
	public static function sortTweets($a, $b)
	{
		return ($a['createdAtTimestamp'] > $b['createdAtTimestamp']) ? -1 : 1;
	}
}
