<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\A\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Installer extends \G2\L\Controller {
	var $models = array('\G2\A\M\Acl');
	
	function index(){
		//apply updates
		$sql = file_get_contents(\G2\Globals::ext_path('chronoforums', 'admin').'sql'.DS.'install.chronoforums.sql');
		
		$queries = \G2\L\Database::getInstance()->split_sql($sql);
		foreach($queries as $query){
			\G2\L\Database::getInstance()->exec(\G2\L\Database::getInstance()->_prefixTable($query));
		}
		
		\GApp::session()->flash('success', rl('Database tables have been installed.'));
		$this->redirect(r_('index.php?ext=chronoforums&act=clear_cache'));
	}
	
	function add_basic_perms(){
		$acl = $this->Acl->find('first', array('conditions' => array('aco' => '\G2\E\Chronoforums\Chronoforums')));
		if(!empty($acl)){
			return;
		}
		
		$perms = Array(
			'rules' => Array(
				'display' => Array(
					'1' => 1,'9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 0, 'owner' => 0
				),
				'make_topics' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 1, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'read_topics' => Array(
					'1' => 1, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 0, 'owner' => 0
				),
				'make_posts' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 1, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'modify_topics' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'list_attachments' => Array(
					'1' => 1, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 0, 'owner' => 0
				),
				'download_attachments' => Array(
					'1' => 1, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 0, 'owner' => 0
				),
				'attach_files' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 1, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'edit_posts' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'delete_posts' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'report_posts' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 1, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'view_reports' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'select_answers' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 1
				),
				'feature_topics' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => 0
				),
				'make_votes' => Array(
					'1' => 0, '9' => 0, '6' => 0, '7' => 0, '2' => 1, '3' => 0, '4' => 0, '5' => 0, '8' => 1, 'owner' => -1
				)
			)
		);
		
		$this->data['Acl'] = $perms;
		$this->data['Acl']['title'] = 'Chronoforums Front Permissions';
		$this->data['Acl']['aco'] = '\G2\E\Chronoforums\Chronoforums';
		$this->data['Acl']['enabled'] = 1;
		$result = $this->Acl->save($this->data);
	}
}
?>