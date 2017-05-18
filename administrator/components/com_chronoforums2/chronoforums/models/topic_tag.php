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
class TopicTag extends \G2\L\Model {
	var $tablename = '#__forums2_topics_tags';
	
	function store($tags, $topic_id){
		if(empty($tags)){
			return ['error' => rl('Error saving tags.')];
		}
		
		if(empty($topic_id)){
			return ['error' => rl('Topic ID missing.')];
		}
		
		foreach($tags as $tag){
			if(!empty($tag) AND is_numeric($tag)){
				$this->insert(['topic_id' => $topic_id, 'tag_id' => $tag]);
			}
		}
		
		return true;
	}
}