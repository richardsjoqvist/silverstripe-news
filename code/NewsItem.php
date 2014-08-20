<?php
/**
 * News item
 */
class NewsItem extends Page
{

	private static $default_parent = 'NewsHolder';
	
	private static $icon = 'silverstripe-news/images/newsitem';
	
	private static $db = array(
		'Date' => 'SS_Datetime',
	);
	
	private static $defaults = array(
		'ProvideComments' => false,
		'ShowInMenus' => false
	);
	
	/**
	 * Use current date as default
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

class NewsItem_Controller extends Page_Controller
{

	private static $allowed_actions = array('rss');

	/**
	 * Handle RSS requests
	 */
	function rss($request = NULL) {
		if($page = DataObject::get_by_id('NewsHolder',$this->ParentID)) {
			$this->redirect($page->Link().'rss', 302);
		}
	}

}
