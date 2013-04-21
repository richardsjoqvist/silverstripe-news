<?php
/**
 * News helper
 */
class NewsHelper {

	/**
	 * Get news items
	 *
	 * @param int $start
	 * @param int $numitems max number of items to return
	 * @param string $namespace
	 * @return DataObjectSet
	 */
	public static function Entries($start=0, $numitems=5, $namespace="") {
		$bt = defined('DB::USE_ANSI_SQL') ? "\"" : "`";
        $filters = array();
		if(!empty($namespace)) {
			$nameSpaces = explode(",",$namespace.",");
			foreach($nameSpaces as $namespace) {
				$namespace = trim($namespace);
				if(!empty($namespace)) {
					if($r = DataObject::get_one("NewsHolder","{$bt}NewsHolder_Live{$bt}.{$bt}Namespace{$bt} = '$namespace'")) {
						$filters[] = "`ParentID` = $r->ID";
					}
				}
			}
		}
		return DataObject::get("NewsItem",join(" OR ",$filters),"{$bt}NewsItem{$bt}.{$bt}Date{$bt} DESC",'',"$start,$numitems");
	}

}
