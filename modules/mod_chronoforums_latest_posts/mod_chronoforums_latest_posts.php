<?php
/**
* COMPONENT FILE HEADER
**/
defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or define("GCORE_SITE", "front");
jimport('cegcore.joomla_gcloader');
if(!class_exists('JoomlaGCLoader')){
	JError::raiseWarning(100, "Please download the CEGCore framework from www.chronoengine.com then install it using the 'Extensions Manager'");
	return;
}

$mod_chronoforums_latest_posts_setup = function() use($params){
	return array(
		'count' => $params->get('count'),
		'forum_id' => $params->get('forum_id'),
	);
};

$output = new JoomlaGCLoader('front', 'chronoforums', 'chronoforums', $mod_chronoforums_latest_posts_setup, array('controller' => 'tasks', 'action' => 'latest_posts'));