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
class Attachment extends \G2\L\Model {
	var $tablename = '#__forums2_posts_attachments';
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = date('Y-m-d H:i:s', time());
		$data['user_id'] = \GApp::user()->get('id');
		
		return $data;
	}
	
	public function removeFiles($attachments){
		if(!empty($attachments)){
			foreach($attachments as $attachment){
				$target = \GApp::extension('chronoforums')->settings()->get('attachments_path').$attachment['Attachment']['vfilename'];
				\G2\L\File::delete($target);
			}
		}
	}
}