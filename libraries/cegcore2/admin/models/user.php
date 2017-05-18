<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\A\M;
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
class User extends \G2\L\Model {
	var $tablename = '#__users';
	var $apptable = true;
	
	var $fieldsMap = array('registerDate' => 'register_date');
	
	
	
	public function remove($id){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		$result = $this
		->fields(['User.*', 'GroupUser.*'])
		->hasOne('\G2\A\M\GroupUser', 'GroupUser', 'user_id')
		->where('id', $id)
		->delete();
		
		if($result !== false){
			return true;
		}else{
			return ['error' => rl('Error deleting user.')];
		}
	}
}