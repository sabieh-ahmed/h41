<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\L;
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
class Document {
	var $cssfiles = array();
	var $csscodes = array();
	var $jsfiles = array();
	var $jscodes = array();
	var $headertags = array();
	var $modules = null;
	var $lang = '';
	var $url = '';
	var $direction = '';
	var $site = '';
	var $title = '';
	var $meta = array();
	var $base = '';
	var $theme = '';

	function __construct($site = GCORE_SITE){
		$app = \GApp::instance($site);
		$this->language = $app->language;
		$this->url = $app->url;
		$this->direction = $app->direction;
		$this->site = $site;
		$this->path = $app->path;
		$this->meta[] = array(
			'http-equiv' => 'content-type',
			'content' => 'text/html; charset=utf-8',
		);
		if(strlen(trim(Config::get('meta.robots', 'index,follow')))){
			$this->meta[] = array('name' => 'robots', 'content' => Config::get('meta.robots', 'index,follow'));
		}
		if(strlen(trim(Config::get('meta.keywords', '')))){
			$this->meta[] = array('name' => 'keywords', 'content' => Config::get('meta.keywords'));
		}
		if(strlen(trim(Config::get('meta.description', '')))){
			$this->meta[] = array('name' => 'description', 'content' => Config::get('meta.description'));
		}
		$this->meta[] = array('name' => 'generator', 'content' => 'ChronoCMS 1.0 - Next generation content management system');
	}

	public static function getInstance($site = GCORE_SITE){
		static $instances;
		if(!isset($instances)){
			$instances = array();
		}
		if(empty($instances[$site])){
			if(\G2\Globals::get('app')){
				$document = '\G2\L\Documents\Document'.strtoupper(\G2\Globals::get('app'));
				$instances[$site] = new $document($site);
			}else{
				$instances[$site] = new self($site);
			}
			return $instances[$site];
		}else{
			return $instances[$site];
		}
	}
	
	public static function _reset(){
		$this->cssfiles = array();
		$this->csscodes = array();
		$this->jsfiles = array();
		$this->jscodes = array();
		$this->headertags = array();
	}
	
	function relative($path){
		if(strpos($path, \G2\Globals::get('ROOT_URL')) !== false){
			$parts = parse_url($path);
			$path = $parts['path'];
		}
		
		return $path;
	}

	function addCssFile($path, $media = 'screen'){
		$path = $this->relative($path);
		
		if(!in_array($path, (array)Arr::getVal($this->cssfiles, array('[n]', 'href')))){
			$this->cssfiles[] = array('href' => $path, 'media' => $media, 'rel' => 'stylesheet', 'type' => 'text/css');
		}
	}

	function addJsFile($path, $type = 'text/javascript'){
		$path = $this->relative($path);
		
		if(!in_array($path, (array)Arr::getVal($this->jsfiles, array('[n]', 'src')))){
			$this->jsfiles[] = array('src' => $path, 'type' => $type);
		}
	}

	function addHeaderTag($code = '', $id = null){
		if(!empty($code)){
			if($id){
				if(!isset($this->headertags[$id])){
					$this->headertags[$id] = $code;
				}
			}else{
				$this->headertags[] = $code;
			}
		}
	}

	function _($name, $params = array()){
		switch($name){
			case 'jquery':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery.js');
			break;
			case 'jquery-noconflict':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery-noconflict.js');
			break;
			case 'jquery-migrate':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery-migrate.js');
			break;
			case 'jquery-ui':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery-ui.min.js');
			break;
			
			case 'semantic-ui':
				//$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/semantic.min.js');
				
				//$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/'.(!empty($params['inline']) ? 'inline/' : '').'reset.css');
				//$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/'.(!empty($params['inline']) ? 'inline/' : '').'site.css');
				//$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/'.(!empty($params['inline']) ? 'inline/' : '').'semantic.min.css');
				
				//$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/fixes.semantic.css');
				if(!empty($params['css'])){
					foreach($params['css'] as $css_item){
						$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/components/'.$css_item.'.inline.min.css');
					}
				}
				if(!empty($params['js'])){
					foreach($params['js'] as $js_item){
						$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/components/'.$js_item.'.min.js');
					}
				}
				
			break;
			case 'calendar':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/calendar/calendar.min.js');
				$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/calendar/calendar.min.css');
			break;
			case 'g2':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/js/g2.js');
			break;
			case 'g2.editor':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/js/g2.editor.js');
			break;
			case 'g2.image_browser':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/js/g2.image_browser.js');
			break;
				
			
			case 'tooltipster':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/tooltipster/tooltipster.bundle.min.js');
				$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/tooltipster/tooltipster.bundle.min.css');
			break;
			case 'jquery.validate':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery.validate.js');
			break;
			case 'jquery.inputmask':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/jquery/jquery.inputmask.js');
			break;
			
			
			case 'editor':
				//run editor files load hook
				$hook_results = \G2\L\Event::trigger('on_editor_load');
				if(in_array(true, $hook_results, true)){
					break;
				}
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/gplugins/geditor/geditor.js');
				$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/gplugins/geditor/geditor.css');
			break;
			case 'highlight':
				$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/highlight/highlight.pack.js');
				$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/highlight/styles/'.(!empty($params['style']) ? $params['style'] : 'default').'.css');
				//$this->addJsCode('hljs.initHighlightingOnLoad();');
			break;
			default:
				break;
		}
	}

	function __($type, $id = '', $params = array()){
		switch($type){
			case 'tabs':
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").tabs();});');
			break;
			case 'accordion':
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").accordion();});');
			break;
			case 'validate':
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").validate();});');
			break;
			case 'keepalive':
				$this->addJsCode('setInterval(function(){jQuery.get("'.Url::current().'");}, '.((5 * 60 * 1000)).');');
			break;
			case 'tooltip':
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").tooltip('.json_encode($params).');});');
			break;
			case 'autocompleter':
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").autoCompleter('.json_encode($params).');});');
			break;
			case 'editor':
				//run editor files load hook
				$hook_results = \G2\L\Event::trigger('on_editor_enable', $id, $params);
				if(in_array(true, $hook_results, true)){
					break;
				}
				$this->addJsCode('jQuery(document).ready(function($){$("'.$id.'").gcoreEditor('.json_encode($params).');});');
			break;
		}
	}

	function addCssCode($content, $media = 'screen'){
		if(!isset($this->csscodes[$media])){
			$this->csscodes[$media] = array();
		}
		if(!in_array($content, $this->csscodes[$media])){
			$this->csscodes[$media][] = $content;
		}
	}

	function addJsCode($content, $type = 'text/javascript'){
		if(!isset($this->jscodes[$type])){
			$this->jscodes[$type] = array();
		}
		if(!in_array($content, $this->jscodes[$type])){
			$this->jscodes[$type][] = $content;
		}
	}

	function getFavicon(){
		$data = array('rel' => 'shortcut icon', 'href' => \G2\Globals::get('FRONT_URL').'assets/images/favicon.ico');
		return \G2\H\Html::_concat($data, array_keys($data), '<link ', ' />');
	}

	function title($title = null){
		if(is_null($title)){
			return $this->title;
		}else{
			$this->title = $title;
		}
	}
	
	function meta($name, $content = null, $http = false){
		if(is_null($content)){
			return isset($this->meta[$name]) ? $this->meta[$name] : null;
		}else{
			$this->meta[$name] = $content;
		}
	}

	function getBase(){
		if(!empty($this->base)){
			return '<base href="'.$this->base.'" />';
		}
		if($this->site != 'admin'){
			return '<base href="'.Url::root().'" />';
		}
		return '';
	}
	
	function getBody(){
		$app = App::getInstance($this->site);
		return $app->getBuffer();
	}
	
	
	public function _startup(){
		$this->_('jquery');
		//$doc->_('jquery-noconflict');
		$this->addJsFile('semantic_js');
		$this->addCssFile('semantic_css');
		//$this->addJsFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/semantic.min.js');
		//$this->addCssFile(\G2\Globals::get('FRONT_URL').'assets/semantic-ui/inline/semantic.min.css');
		
		$this->_('calendar');
		$this->_('g2');
	}
	
	public function _build($buffer){
		
		$this->addJsCode("
			jQuery(document).ready(function($){
				//default modules
				
				$('body').on('contentChange', function(){
					if(jQuery.fn.tab != undefined){
						$('.ui.menu.G2-tabs .item').tab();
					}
					if(jQuery.fn.dropdown != undefined){
						$('.ui.dropdown').dropdown({'forceSelection' : false});
					}
					if(jQuery.fn.checkbox != undefined){
						$('.ui.checkbox').checkbox('refresh');
					}
					if(jQuery.fn.accordion != undefined){
						$('.ui.accordion').accordion('refresh');
					}
					
					//G2 actions
					$.G2.actions.ready();
				});
				$('body').trigger('contentChange');
				
				//toolbar
				$('.ui.toolbar-button[data-url]').on('click', function(e){
					if($(this).attr('data-form')){
						var toolbar_form = $($(this).attr('data-form'));
					}else{
						var toolbar_form = $(this).closest('form');
					}
					
					toolbar_form.attr('action', $(this).data('url'));
					
					if($(this).attr('name')){
						toolbar_form.append($('<input />').attr('type', 'hidden').attr('name', $(this).attr('name')).val(1));
					}
					
					if($(this).data('selections') == '1' && toolbar_form.find('.ui.selector.checkbox.checked').length == 0){
						alert($(this).data('message'));
						return false;
					}
					toolbar_form.submit();
				});
				
				//list selectors
				$('.ui.selector.checkbox').checkbox({
					onChecked: function(){
						$(this).closest('tr').addClass('warning');
					},
					onUnchecked: function(){
						$(this).closest('tr').removeClass('warning');
					}
				});
				$('.ui.selector.checkbox').checkbox('attach events', '.ui.select_all.checkbox');
				
				//errors
				//$(':input[data-error]').closest('.field').addClass('error');
				
				//calendar
				$('[data-calendar]').each(function(i, calfield){
					var mindate = null;
					if($(calfield).data('mindate')){
						var parts = $(calfield).data('mindate').split('-');
						var mindate = new Date(parts[0], parts[1]-1, parts[2]); 
					}
					var maxdate = null;
					if($(calfield).data('maxdate')){
						var parts = $(calfield).data('maxdate').split('-');
						var maxdate = new Date(parts[0], parts[1]-1, parts[2]); 
					}
					$(calfield).closest('.field').calendar({
						startMode : $(calfield).data('startmode'),
						type : $(calfield).data('type'),
						minDate : mindate,
						maxDate : maxdate,
						startCalendar: $(calfield).data('startcalendar') ? $($(calfield).data('startcalendar')).closest('.field') : null,
						endCalendar: $(calfield).data('endcalendar') ? $($(calfield).data('endcalendar')).closest('.field') : null,
						
						formatter:{
							date: function (date, settings) {
								if (!date) return '';
								var day = date.getDate();
								var month = date.getMonth() + 1;
								var year = date.getFullYear();
								var hour = date.getHours();
								var minute = date.getMinutes();
								
								var value = $(calfield).data('format') ? $(calfield).data('format') : 'y-m-d';
								value = value.replace('y', year).replace('m', month).replace('d', day).replace('h', hour).replace('i', minute);
								
								return value;
							}
						},
						popupOptions:{
							position: 'top center'
						},

						text:{
							days: $(calfield).data('days') ? $(calfield).data('days').split(',') : ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
							months: $(calfield).data('months') ? $(calfield).data('months').split(',') : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							monthsShort: $(calfield).data('monthsshort') ? $(calfield).data('monthsshort').split(',') : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
							today: $(calfield).data('today') ? $(calfield).data('today').split(',') : 'Today',
							now: $(calfield).data('now') ? $(calfield).data('now').split(',') : 'Now',
							am: $(calfield).data('am') ? $(calfield).data('am').split(',') : 'AM',
							pm: $(calfield).data('pm') ? $(calfield).data('pm').split(',') : 'PM'
						}
					});
				});
				
				$('[data-autocomplete]').each(function(i, dropfield){
					/*
					if($(dropfield).data('provider')){
						$($(dropfield).data('provider')).on('change', function(){
							$(dropfield).api('query');
						});
					}
					*/
					$(dropfield).closest('.ui.search.dropdown').dropdown({
						apiSettings : {
							url: $(dropfield).data('url') + '&' + $(dropfield).attr('name') + '={query}',
							cache : false,
							beforeSend: function(settings) {
								if($(dropfield).data('provider')){
									settings.data[$($(dropfield).data('provider')).attr('name')] = $($(dropfield).data('provider')).val();
								}
								
								return settings;
							},
							onResponse : function(Response){
								if(!Response.hasOwnProperty('results')){
									var results = [];
									results['success'] = true;
									results['results'] = [];
									
									var count = 0;
									$.each(Response, function(key, obj){
										results['results'][count] = {};
										results['results'][count]['value'] = key;
										results['results'][count]['name'] = obj;
										count = count + 1;
									});
									
									return results;
								}
							}
						},
						minCharacters: $(dropfield).data('mincharacters') ? $(dropfield).data('mincharacters') : 0,
						message : {noResults : $(dropfield).data('noresults') ? $(dropfield).data('noresults') : 'No results found'},
						//saveRemoteData:false
					});
				});
			});
		");
		
		$this->_semantic($buffer);
		//$this->_('semantic-ui', ['inline' => true]);
	}
	
	public function _semantic($buffer){
		preg_match_all('/ class=("|\')ui (.*?)(\1)/i', $buffer, $classes);
		$classes = array_unique($classes[2]);
		$matches = [];
		foreach($classes as $class){
			$matches = array_merge($matches, explode(' ', $class));
		}
		$matches = array_filter(array_unique($matches));
		
		$uicoms = [
			'button',
			'container',
			'divider',
			'flag',
			'header',
			'icon',
			'image',
			'input',
			'label',
			'list',
			'loader',
			'rail',
			'reveal',
			'segment',
			'steps', //2
			'breadcrumb',
			'form',
			'grid',
			'menu',
			'message',
			'table',
			'ad',
			'card',
			'comments', //2
			'feed',
			'item',
			'statistic',
			'accordion',
			'checkbox',
			'dimmer',
			'dropdown',
			'embed',
			'modal',
			'nag',
			'popup',
			'progress',
			'rating',
			'search',
			'shape',
			'sidebar',
			'sticky',
			'tab',
			'transition',
			'api',
			'form',
			'state',
			'visibility'
		];
		
		$uicoms2 = ['comments' => 'comment', 'steps' => 'step'];
		
		$css_defaults = ['reset', 'site', 'transition', 'icon', 'message', 'label', 'button', 'dropdown', 'checkbox', 'popup', 'table'];
		
		$css_items = array_intersect($matches, $uicoms);
		$css_items = array_merge($css_defaults, $css_items);
		$css_items = array_unique($css_items);
		
		foreach($css_items as $k => $css_item){
			if(isset($uicoms2[$css_item])){
				$css_items[$k] = $uicoms2[$css_item];
			}
		}
		
		$js_items = ['site', 'state', 'api', 'colorize', 'transition', 'popup', 'dropdown', 'checkbox'];
		
		foreach($uicoms as $uicom){
			foreach($this->headertags as $tag){
				if(strpos($tag, '.'.$uicom.'(') !== false){
					$js_items[] = $uicom;
				}
			}
			
			foreach($this->jscodes['text/javascript'] as $tag){
				if(strpos($tag, '.'.$uicom.'(') !== false){
					$js_items[] = $uicom;
				}
			}
		}
		
		$extra_js = array_intersect(['dimmer', 'progress'], $css_items);
		
		$js_items = array_merge($js_items, $extra_js);
		$js_items = array_unique($js_items);
		
		$inline = \G2\Globals::get('app') ? '.inline' : '';
		
		$css_files = [];
		foreach($css_items as $css_item){
			$path = \G2\Globals::get('FRONT_URL').'assets/semantic-ui/components/'.$css_item.$inline.'.min.css';
			$path = $this->relative($path);
			$css_files[] = array('href' => $path, 'media' => 'screen', 'rel' => 'stylesheet', 'type' => 'text/css');
		}
		$path = \G2\Globals::get('FRONT_URL').'assets/semantic-ui/fixes.semantic.css';
		$path = $this->relative($path);
		$css_files[] = array('href' => $path, 'media' => 'screen', 'rel' => 'stylesheet', 'type' => 'text/css');
		
		$js_files = [];
		foreach($js_items as $js_item){
			$path = \G2\Globals::get('FRONT_URL').'assets/semantic-ui/components/'.$js_item.'.min.js';
			$path = $this->relative($path);
			$js_files[] = array('src' => $path, 'type' => 'text/javascript');
		}
		
		$pos = array_search('semantic_css', \G2\L\Arr::getVal($this->cssfiles, '[n].href', []));
		array_splice($this->cssfiles, $pos, 1, $css_files);
		
		$pos = array_search('semantic_js', \G2\L\Arr::getVal($this->jsfiles, '[n].src', []));
		array_splice($this->jsfiles, $pos, 1, $js_files);
		
		//pr($css_items);
		//pr($js_items);
		
	}
}