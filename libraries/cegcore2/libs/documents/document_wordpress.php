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
class DocumentWordpress extends \G2\L\Document {

	
	function _($name, $params = array()){
		if($name == 'jquery'){
			wp_enqueue_script('jquery');
			return;
		}
		if($name == 'jquery-migrate'){
			wp_enqueue_script('jquery-migrate');
			return;
		}
		if($name == 'jquery-ui'){
			$jquery_ui = array(
				"jquery-ui-core",			//UI Core - do not remove this one
				"jquery-ui-widget",
				"jquery-ui-mouse",
				"jquery-ui-accordion",
				"jquery-ui-autocomplete",
				"jquery-ui-slider",
				"jquery-ui-tabs",
				"jquery-ui-sortable",	
				"jquery-ui-draggable",
				"jquery-ui-droppable",
				"jquery-ui-selectable",
				"jquery-ui-position",
				"jquery-ui-datepicker",
				"jquery-ui-resizable",
				"jquery-ui-dialog",
				"jquery-ui-button"
			);
			foreach($jquery_ui as $script){
				wp_enqueue_script($script);
			}
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
	function title($title = ''){
		$document = \JFactory::getDocument();
		if(!empty($title)){
			$document->setTitle($title);
		}else{
			return $document->getTitle();
		}
	}
	
}