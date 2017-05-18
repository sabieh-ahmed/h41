<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\L\Documents;
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
class DocumentJoomla extends \G2\L\Document {

	
	function _($name, $params = array()){
		if($name == 'jquery'){
			\JHtml::_('jquery.framework');
			return;
		}
		parent::_($name, $params);
	}
	/*
	function addCssFile($path, $media = 'screen'){
		$document = \JFactory::getDocument();
		$document->addStyleSheet($path);
	}

	function addJsFile($path, $type = 'text/javascript'){
		$document = \JFactory::getDocument();
		$document->addScript($path);
	}
	
	function addCssCode($content, $media = 'screen'){
		$document = \JFactory::getDocument();
		$document->addStyleDeclaration($content);
	}

	function addJsCode($content, $type = 'text/javascript'){
		$document = \JFactory::getDocument();
		$document->addScriptDeclaration($content);
	}
	*/
	function title($title = null){
		$document = \JFactory::getDocument();
		if(is_null($title)){
			return $document->getTitle();
		}else{
			$document->setTitle($title);
		}
	}
	
	function meta($name, $content = null, $http = false){
		$document = \JFactory::getDocument();
		
		if(is_null($content)){
			return $document->getMetaData($name);
		}else{
			$document->setMetaData($name, $content, $http);
		}
	}
	
	
	public static function _header(){
		$doc = \G2\L\Document::getInstance();
		static $used;
		if(!isset($used)){
			$used = array();
		}
		$chunks = array();
		
		$JDocument = \JFactory::getDocument();
		if(!method_exists($JDocument, 'addCustomTag')){
			return;
		}
		$HtmlHelper = new \G2\H\Html();
		//add css files list
		foreach($doc->cssfiles as $k => $cssfile){
			if(empty($used['cssfiles'][$k])){
				$used['cssfiles'][$k] = true;
				$cssfile['href'] = \G2\Globals::fix_urls($cssfile['href']);
				$chunks[] = $HtmlHelper->attrs($cssfile)->tag('link');
			}
		}
		//add css code list
		foreach($doc->csscodes as $media => $codes){
			$chunks[] = $HtmlHelper->attrs(['type' => 'text/css', 'media' => $media])->content(implode("\n", $codes))->tag('style');
			foreach($doc->csscodes[$media] as $k => $code){
				unset($doc->csscodes[$media][$k]);
			}
		}
		//add js files list
		foreach($doc->jsfiles as$k => $jsfile){
			if(empty($used['jsfiles'][$k])){
				$used['jsfiles'][$k] = true;
				$jsfile['src'] = \G2\Globals::fix_urls($jsfile['src']);
				$chunks[] = $HtmlHelper->attrs($jsfile)->content('')->tag('script');
			}
		}
		//add js code list
		foreach($doc->jscodes as $type => $codes){
			foreach($doc->jscodes[$type] as $k => $code){
				$chunks[] = $HtmlHelper->attrs(['type' => $type])->content($code)->tag('script');
				unset($doc->jscodes[$type][$k]);
			}
		}

		foreach($doc->headertags as $k => $code){
			$chunks[] = $code;
			unset($doc->headertags[$k]);
		}
		
		foreach($chunks as $chunk){
			if(in_array($chunk, $JDocument->_custom)){
				continue;
			}
			$JDocument->addCustomTag(\G2\Globals::fix_urls($chunk));
		}
		
		unset($HtmlHelper);
	}
	
}