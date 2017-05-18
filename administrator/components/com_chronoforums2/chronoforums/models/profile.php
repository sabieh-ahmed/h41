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
class Profile extends \G2\L\Model {
	var $tablename = '#__forums2_users_profiles';
	
	public function read($id){
		if(empty($id)){
			$id = \GApp::user()->get('id');
		}
		if(empty($id)){
			return false;
		}
		
		$result = $this
		->belongsTo('\G2\A\M\User', 'User', 'user_id')
		->where('User.id', $id)
		->select('first', ['json' => ['Profile.params']]);
		
		if($result !== false){
			return $result;
		}else{
			return false;
		}
	}
	
	public function remove($id){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		$result = $this->where('user_id', $id)->delete();
		
		if($result !== false){
			return true;
		}else{
			return ['error' => rl('Error deleting profile.')];
		}
	}
	
	public function updateCounters($id){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$post_count = $Post
		->where('Post.user_id', $id)
		->select('count');
		
		$Answer = new \G2\A\E\Chronoforums\M\Answer();
		$answer_count = $Answer
		->belongsTo('\G2\A\E\Chronoforums\M\Post', 'Post', 'post_id')
		->where('Post.user_id', $id)
		->select('count');
		
		$Vote = new \G2\A\E\Chronoforums\M\Vote();
		$vote_count = $Vote
		->belongsTo('\G2\A\E\Chronoforums\M\Post', 'Post', 'post_id')
		->where('Post.user_id', $id)
		->select('count');
		
		unset($Post);
		unset($Answer);
		unset($Vote);
		
		$result = $this->where('user_id', $id)->update(['post_count' => $post_count, 'answer_count' => $answer_count, 'vote_count' => $vote_count]);
		
		return $result;
	}
	
	public function checkApproval($threshold = 0, $approved = true){
		$user = \GApp::user();
		if($user->get('id')){
			if($approved){
				$case = [['Post.published', 1], 'AND', ['Topic.published', 1]];
			}else{
				$case = [['Post.published', 0], 'OR', ['Topic.published', 0]];
			}
			//check the users posts
			$Post = new \G2\A\E\Chronoforums\M\Post();
			$approved_posts = $Post->belongsTo('\G2\A\E\Chronoforums\M\Topic', 'Topic', 'topic_id')
			->whereGroup(array_merge([['Post.user_id', $user->get('id')], 'AND'], $case))
			->select('count');
			
			unset($Post);
			
			if($approved_posts >= $threshold){
				return true;
			}
		}
		
		return false;
	}
}