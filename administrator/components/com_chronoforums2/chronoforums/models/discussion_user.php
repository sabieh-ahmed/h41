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
class DiscussionUser extends \G2\L\Model {
	var $tablename = '#__pm_discussions_users';
	
	public function getUnreadCount(){
		$count = $this
		->hasOne('\G2\A\E\Chronoforums\M\Message', 'Message', [['Message.discussion_id', 'DiscussionUser.discussion_id', '=', 'field'], 'AND', ['Message.created', 'DiscussionUser.last_read', '>', 'field']])
		->fields(['COUNT(DISTINCT(Message.discussion_id))' => 'Message.count'])
		->where('DiscussionUser.user_id', \GApp::user()->get('id'))
		->select('first');
		
		return (isset($count['Message']['count']) ? $count['Message']['count'] : 0);
	}
}