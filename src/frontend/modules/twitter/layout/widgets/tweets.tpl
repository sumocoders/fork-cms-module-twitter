{*
variables that are available:
- {$widgetTwitterTweets}: contains an array with the tweets. Each element contains data about the tweet.
*}

{cache:{$LANGUAGE}_twitterWidgetTweetsCache}
{option:widgetTwitterTweets}
{iteration:widgetTwitterTweets}
<div>{$widgetTwitterTweets.createdAtTimestamp|timeago} -
  <a rel="nofollow" href="http://twitter.com/{$widgetTwitterTweets.user.screen_name}">@{$widgetTwitterTweets.user.screen_name}</a> - {$widgetTwitterTweets.htmlText}
</div>
{/iteration:widgetTwitterTweets}
{/option:widgetTwitterTweets}
{/cache:{$LANGUAGE}_twitterWidgetTweetsCache}
