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
class Html extends \G2\L\Helper{
	var $attributes = [];
	var $options = [];
	var $selected = [];
	var $tag = '';
	var $content = false;
	var $value = false;
	var $label = false;
	var $holder = false;
	var $ghost = false;
	
	public function reset(){
		$this->tag = '';
		$this->content = false;
		$this->value = false;
		$this->label = false;
		$this->holder = false;
		$this->ghost = false;
		$this->attributes = [];
		$this->options = [];
		$this->selected = [];
	}
	
	public function content($content){
		$this->content = $content;
		return $this;
	}
	
	public function ghost($ghost){
		$this->ghost = $ghost;
		return $this;
	}
	
	public function options($params){
		$this->options = $params;
		return $this;
	}
	
	public function selected($params){
		$this->selected = $params;
		return $this;
	}
	
	public function attr($name, $value){
		$this->attributes[$name] = $value;
		return $this;
	}
	
	public function attrs($params){
		$this->attributes = array_merge($this->attributes, $params);
		return $this;
	}
	
	public function _attr($name, $value){
		return $name.'="'.htmlspecialchars($value).'"';
	}
	
	public function label($text){
		$this->label = $text;
		return $this;
	}
	
	public function val($value){
		$this->value = $value;
		$this->attributes['value'] = $value;
		return $this;
	}
	
	public function name($name){
		$this->attributes['name'] = $name;
		return $this;
	}
	
	public function checked($checked = true){
		if($checked){
			$this->attributes['checked'] = 'checked';
		}else{
			if(isset($this->attributes['checked'])){
				unset($this->attributes['checked']);
			}
		}
		
		return $this;
	}
	
	public function addClass($class, $prepend = false){
		if(empty($this->attributes['class'])){
			$this->attributes['class'] = $class;
		}else{
			if($prepend){
				$this->attributes['class'] = $class.' '.$this->attributes['class'];
			}else{
				$this->attributes['class'] = $this->attributes['class'].' '.$class;
			}
		}
		
		return $this;
	}
	
	public function input($type = 'text', $type2 = ''){
		$this->tag = 'input';
		
		if(empty($this->attributes['type'])){
			$this->attributes['type'] = $type;
		}
		
		if($type == 'checkbox'){
			$holder = [];
			$holder[] = 'ui checkbox';
			if($type2){
				$holder[] = $type2;
			}
			$this->holder = implode(' ', $holder);
		}
		
		if($type == 'radio'){
			$holder = [];
			$holder[] = 'ui radio checkbox';
			if($type2){
				$holder[] = $type2;
			}
			$this->holder = implode(' ', $holder);
		}
		
		if($type == 'textarea'){
			$this->tag = 'textarea';
			$this->content = !empty($this->attributes['value']) ? $this->attributes['value'] : '';
		}
		
		if($type == 'button'){
			$this->tag = 'button';
			$this->addClass('ui button', true);
		}
		
		if($type == 'button_link'){
			$this->tag = 'a';
			$this->addClass('ui button', true);
			unset($this->attributes['type']);
		}
		
		if(in_array($type, ['header', 'message', 'custom', 'image'])){
			$this->tag = $this->attributes['tag'];
			unset($this->attributes['type']);
			unset($this->attributes['tag']);
		}
		
		if($type == 'calendar'){
			$this->attributes['type'] = 'text';
			$this->attributes['data-calendar'] = '1';
		}
		
		if($type == 'select'){
			$this->tag = 'select';
			$this->addClass('ui dropdown');
			
			$options = [];
			if(!empty($this->options)){
				foreach($this->options as $value => $label){
					$option_params = ['value' => $value];
					
					if(!empty($this->selected) AND is_array($this->selected) AND in_array($value, $this->selected)){
						$option_params['selected'] = 'selected';
					}
					
					$options[] = $this->_build('option', $option_params, $label);
				}
			}
			$this->content = implode("\n", $options);
		}
		
		//return $this->build();
		return $this;
	}
	
	private function _build($tag, $params = array(), $content = false){
		$out = [];
		$out[] = '<'.$tag;
		foreach($params as $param => $val){
			if(!is_array($val)){
				$out[] = $this->_attr($param, $val);
			}
		}
		if($content === false){
			$out[] = '/>';
		}else{
			$out[] = '>'.$content.'</'.$tag.'>';
		}
		return implode(' ', $out);
	}
	
	
	
	public function build(){
		$return = $this->_build($this->tag, $this->attributes, $this->content);
		
		$this->reset();
		
		return $return;
	}
	
	public function tag($tag){
		$this->tag = $tag;
		
		return $this->build();
	}
	
	public function field($class = 'field', $reset = true, $ghost = true){
		$output = [];
		
		if(!empty($this->attributes['type']) AND ($this->attributes['type'] == 'checkbox' OR $this->attributes['type'] == 'radio')){
			$class = 'inline field';
		}
		
		if($this->label !== false){
			$label_attrs = [];
			if(!empty($this->attributes['id'])){
				$label_attrs['for'] = $this->attributes['id'];
			}
			$output[] = $this->_build('label', $label_attrs, $this->label);
		}
		
		if($this->ghost !== false AND $ghost === true){
			$output[] = $this->_build('input', ['type' => 'hidden', 'name' => str_replace('[]', '', $this->attributes['name']), 'value' => $this->ghost, 'data-ghost' => 1]);
		}
		
		$output[] = $this->_build($this->tag, $this->attributes, $this->content);
		
		if($this->holder !== false){
			$label = array_shift($output);
			$output[] = $label;
		}
		
		$output = implode("\n", $output);
		
		if($this->holder !== false){
			$output = $this->_build('div', ['class' => $this->holder], $output);
		}
		
		if(!empty($class)){
			$output = $this->_build('div', ['class' => $class], $output);
		}
		
		if($reset){
			$this->reset();
		}
		
		return $output;
	}
	
	public function fields($fields = [], $class = ''){
		$output = [];
		
		if(empty($fields) AND !empty($this->options)){
			$fields_label = $this->label;
			
			$counter = 0;
			$field_id = !empty($this->attributes['id']) ? $this->attributes['id'] : '';
			
			foreach($this->options as $value => $label){
				$this->label($label);
				$this->val($value);
				
				if(!empty($this->selected) AND is_array($this->selected) AND in_array($value, $this->selected)){
					$this->checked();
				}else{
					$this->checked(false);
				}
				
				if(!empty($field_id)){
					$this->attributes['id'] = $field_id.$counter;
				}
				
				if(!empty($this->attributes['data-validationrules']) AND $counter > 0){
					unset($this->attributes['data-validationrules']);
				}
				
				if(!empty($this->attributes['data-validate']) AND $counter > 0){
					unset($this->attributes['data-validate']);
				}
				
				$fields[] = $this->field('field', false, false);
				
				$counter++;
			}
			
			$this->label($fields_label);
		}
		
		if($this->label !== false){
			$output[] = $this->_build('label', [], $this->label);
		}
		
		if($this->ghost !== false){
			$output[] = $this->_build('input', ['type' => 'hidden', 'name' => str_replace('[]', '', $this->attributes['name']), 'value' => $this->ghost, 'data-ghost' => 1]);
		}
		
		$output = array_merge($output, $fields);
		
		$output = implode("\n", $output);
		
		$output = $this->_build('div', ['class' => !empty($class) ? $class : 'fields'], $output);
		
		$this->reset();
		
		return $output;
	}
}