<?php
/**
 * News helper
 */
class NewsHelper
{

	/**
	 * Get news items
	 *
	 * @param int $offset
	 * @param int $maxitems Max number of items to return
	 * @param string $namespace
	 * @return DataList
	 */
	public static function Entries($offset=0, $maxitems=5, $namespace=null) {
		if($namespace == '*') $namespace = null;
		$filters = array();
		if($namespace) {
			$namespaces = explode(',',$namespace);
			if($namespaces = array_filter($namespaces)) {
				if($newsholders = DataObject::get('NewsHolder')->filter(array('Namespace' => $namespaces))) {
					$filters['ParentID'] = array();
					foreach($newsholders as $newsholder) $filters['ParentID'][] = $newsholder->ID;
				}
			}
		}
		return DataObject::get('NewsItem')->filter($filters)->sort('Date DESC')->limit($maxitems, $offset);
	}

}
