<?php

/**
 * This is the tweets widget.
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class FrontendTwitterWidgetTweets extends FrontendBaseWidget
{
	/**
	 * Execute the extra
	 */
	public function execute()
	{
		parent::execute();
		$this->loadTemplate();
		try
		{
			$this->parse();
		}
		catch(\TijsVerkoyen\Twitter\Exception $e)
		{
			// in debugmode we want to see the exceptions
			if(SPOON_DEBUG) throw $e;

			// stop
			else return false;
		}
	}

	/**
	 * Parse into template
	 */
	private function parse()
	{
		// assign data
		$this->tpl->assign('widgetTwitterTweets', FrontendTwitterModel::getLastTweets(FrontendModel::getModuleSetting('twitter', 'count') ?: 10));
	}
}
