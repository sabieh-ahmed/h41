<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\H;
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
class Sorter extends \G2\L\Helper{
	var $url;
	
	function __construct(&$view = null){
		$this->url = !empty($view->url) ? $view->url : \G2\L\Url::current();
	}
	
	public function link($text, $alias){
		$orderdir = \GApp::session()->get('composer.order.'.$alias.'.dir', '');
		$orderdir_new = ($orderdir == '') ? 'asc' : ($orderdir == 'asc' ? 'desc' : 'asc');
		$url = r_(\G2\L\Url::build($this->url, array('orderfld' => $alias, 'orderdir' => $orderdir_new)));
		$cancel_url = r_(\G2\L\Url::build($this->url, array('orderfld' => $alias, 'orderdir' => 'clear')));
		
		$HtmlHelper = new \G2\H\Html();
		$sort_link = $HtmlHelper->attrs(['href' => $url])->content($text.'&nbsp;<i class="sort alphabet '.$orderdir.'ending icon"></i>')->tag('a');
		
		if(!empty($orderdir)){
			$cancel_link = $HtmlHelper->attrs(['href' => $cancel_url])->content('<i class="cancel icon small inverted red"></i>')->tag('a');
		}else{
			$cancel_link = '';
		}
		
		unset($HtmlHelper);
		
		return $sort_link.$cancel_link;
	}
}