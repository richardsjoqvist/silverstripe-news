<?php
/**
 * News item
 */
class NewsItem extends Page {
	
	static $default_parent = 'NewsHolder';
	
	static $icon = "news/images/newsitem";
	
	static $db = array(
		"Date" => "SS_Datetime",
	);
	
	static $defaults = array(
		"ProvideComments" => false,
		'ShowInMenus' => false
	);
	
	/**
	 * Use todays date as default
	 */
	public function populateDefaults(){
		parent::populateDefaults();
		$this->setField('Date', date('Y-m-d H:i:s', strtotime('now')));
	}
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$dateField = DateField::create('Date')->setConfig('showcalendar', true);
		$fields->addFieldToTab('Root.Main', $dateField, 'Content');
		return $fields;
	}

}

class NewsItem_Controller extends Page_Controller {

	/**
	 * Handle RSS requests
	 *
	 * @param SS_HTTPRequest $request
	 */
	function rss($request=null) {
		$bt = defined('DB::USE_ANSI_SQL') ? "\"" : "`";
		if($r = DataObject::get_one("NewsHolder","{$bt}NewsHolder_Live{$bt}.{$bt}ID{$bt} = '{$this->ParentID}'")) {
			$this->redirect($r->URLSegment, 302);
		}
		exit;
	}

}
