<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\A\E\Chronoforums\M;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Tag extends \G2\L\Model {
	var $tablename = '#__tags';
	
	public function validate($data = array(), $new = false, $list = []){
		$return = true;
		if(empty($data['title'])){
			$return = false;
			$this->errors['title'] = rl('Tag title is required.');
		}
		
		return $return;
	}
	
	public function getList($public = true){
		if(empty($public)){
			$this->where('public', 1);
		}
		$this->where('published', 1);
		
		return $this->fields(['Tag.id', 'Tag.title', 'Tag.ordering'])->order(['Tag.ordering' => 'desc'])->select('list');
	}
}