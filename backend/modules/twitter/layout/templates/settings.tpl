{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="pageTitle">
  <h2>{$lblModuleSettings|ucfirst}: {$lblTwitter}</h2>
</div>

{form:settings}
  <div class="box">
    <div class="heading">
      <h3>{$lblTimeline|ucfirst}</h3>
    </div>
    <div class="options">
      <label for="count">{$lblCountTweets|ucfirst}</label>
      {$txtCount} {$txtCountError}
    </div>
    <div class="options">
      <label for="addValue-accounts">{$lblAccounts|ucfirst}</label>
      {$txtAccounts} {$txtAccountsError}
    </div>
    <div class="options">
      <label for="addValue-hashtags">{$lblHashtags|ucfirst}</label>
      {$txtHashtags} {$txtHashtagsError}
    </div>
  </div>

  <div class="box horizontal">
    <div class="heading">
      <h3>Twitter {$lblSettings}</h3>
    </div>
    <div class="options labelWidthLong">
      <p>
        <label for="twitterConsumerKey">{$lblTwitterConsumerKey|ucfirst}</label>
        {$txtTwitterConsumerKey} {$txtTwitterConsumerKeyError}
        <span class="helpTxt">{$msgHelpTwitterConsumerKey}</span>
      </p>
      <p>
        <label for="twitterConsumerSecret">{$lblTwitterConsumerSecret|ucfirst}</label>
        {$txtTwitterConsumerSecret} {$txtTwitterConsumerSecretError}
        <span class="helpTxt">{$msgHelpTwitterConsumerSecret}</span>
      </p>
      <p>
        <label for="twitterOauthToken">{$lblTwitterOauthToken|ucfirst}</label>
        {$txtTwitterOauthToken} {$txtTwitterOauthTokenError}
        <span class="helpTxt">{$msgHelpTwitterOauthToken}</span>
      </p>
      <p>
        <label for="twitterOauthTokenSecret">{$lblTwitterOauthTokenSecret|ucfirst}</label>
        {$txtTwitterOauthTokenSecret} {$txtTwitterOauthTokenSecretError}
        <span class="helpTxt">{$msgHelpTwitterOauthTokenSecret}</span>
      </p>
    </div>
  </div>


  <div class="fullwidthOptions">
    <div class="buttonHolderRight">
      <input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
    </div>
  </div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}