<?php
/**
 * News holder
 */
class NewsHolder extends Page {
	
	static $icon = "news/images/newsholder";
	
	static $db = array(
		"RSSTitle" => "Text",
		"Namespace" => "Text",
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Config", new TextField("RSSTitle", _t("NewsHolder.RSSFEED", "News RSS feed")));
		$fields->addFieldToTab("Root.Config", new TextField("Namespace", _t("NewsHolder.NAMESPACE", "News namespace")));
		return $fields;
	}

	/**
	 * Create default news setup
	 */
	function requireDefaultRecords() {
		parent::requireDefaultRecords();
		
		if(!DataObject::get_one('NewsHolder')) {
			$newsHolder = new NewsHolder();
			$newsHolder->Title = "News";
			$newsHolder->Namespace = "global";
			$newsHolder->URLSegment = "news";
			$newsHolder->Status = "Published";
			$newsHolder->write();
			$newsHolder->publish("Stage", "Live");
			
			$newsItem = new NewsItem();
			$newsItem->Title = _t('NewsHolder.SUCTITLE', "SilverStripe news module successfully installed");
			$newsItem->Date = date("Y-m-d");
			$newsItem->URLSegment = 'sample-news-item';
			$newsItem->Content = _t('NewsHolder.SUCCONTENT',"Congratulations, the SilverStripe news module has been successfully installed. This news item can be safely deleted.");
			$newsItem->Status = "Published";
			$newsItem->ParentID = $newsHolder->ID;
			$newsItem->write();
			$newsItem->publish("Stage", "Live");
			
			Database::alteration_message("News item created","created");
		}
	}

}

class NewsHolder_Controller extends Page_Controller {

	function init() {
		parent::init();
		
		// Create a <link> tag point to the RSS feed
		RSSFeed::linkToFeed($this->Link() . "rss", _t('NewsHolder.RSSFEED',$this->RSSTitle));
	}

	/**
	 * Get new items connected to this news holder
	 *
	 * @param int $limit
	 * @return DataList
	 */
	function NewsItems($limit = 10) {
		$start = isset($_GET['start']) ? (int) $_GET['start'] : 0;
		return NewsHelper::Entries($start,$limit,$this->Namespace);
	}

	/**
	 * Output the RSS feed for items connected to the requested news holder
	 *
	 * @param SS_HTTPRequest $request
	 */
	function rss($request=null) {
		$namespace = $this->Namespace;
		if($request) {
			$requestedNamespace = $request->param('ID');
			if( !empty($requestedNamespace) )
			{
				$namespace = trim($requestedNamespace);
				$namespace = $namespace == "*" ? "" : $namespace;
			}
		}

		if($entries = NewsHelper::Entries(0, 20, $namespace)) {
			$rss = new RSSFeed($entries, $this->Link(), $this->RSSTitle, "", "Title", "ParsedContent");
			$rss->outputToBrowser();
		}
	}
	
}
