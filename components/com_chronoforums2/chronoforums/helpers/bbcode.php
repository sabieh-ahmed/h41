<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\E\Chronoforums\H;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Bbcode extends \G2\L\Helper {
	
	static $emotions = array(
		' :!:',
		' :?:',
		' :oops:',
		' :D',
		' :)',
		' ;)',
		' :(',
		' :o',
		' :shock:',
		' :?',
		' 8-)',
		' :lol:',
		' :x',
		' :P',
		' :cry:',
		' :evil:',
		' :twisted:',
		' :roll:',
		' :idea:',
		' :arrow:',
		' :|',
		' :mrgreen:',
		' :geek:',
		' :ugeek:'
	);
	
	static $replacments = array(
		'img' => '<img src="{value}" alt="{value}" class="ui image" />',
		'email' => '<a href="mailto:{value}">{value}</a>',
		'url' => '<a class="cfu-postlink" target="_blank" rel="nofollow"{param}>{value}</a>',
		'*' => '<li>{value}</li>',
		'list' => '<ol{param}>{value}</ol>',
		'b' => '<strong>{value}</strong>',
		'i' => '<em>{value}</em>',
		'u' => '<u>{value}</u>',
		'size' => '<span{param}>{value}</span>',
		'color' => '<span{param}>{value}</span>',
		'quote' => '<div class="ui message icon"><i class="icon quote left"></i><div class="content">{param}<p>{value}</p></div></div>',
		'youtube' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/{value}?showinfo=0" frameborder="0" allowfullscreen></iframe>',
		'icon' => '<i class="icon {value}"></i>',
	);
	
	static $parameters = [
		'url' => ' href="{param}"',
		'size' => ' style="font-size:{param}%"',
		'color' => ' style="color:{param}"',
		'quote' => '<div class="header">{param}:</div>',
		'list' => ' start="{param}"',
	];
	
	static $default_parameters = [
		'url' => ' href="{value}"',
	];

	function parse($text){
		$fparams = $this->get('fparams');
		$text = htmlspecialchars($text);
		
		$text = $this->replaceEmails($text);
		$text = $this->replaceURLs($text);
		
		$text = $this->replaceBBCode($text);
		
		$text = str_replace("\r", '', $text);
		$text = trim($text);
		
		$text = '<p>'.$text.'</p>';
		$text = nl2br($text);
		
		$text = $this->parseCode($text);
		$text = $this->parseSmilies($text);

		return $text;
	}
	
	function replaceBBCode($string, $lastver = ''){
		$types = array_keys(self::$replacments);
		
		foreach($types as $type){
			preg_match_all('/\[('.preg_quote($type).')([^\]]*?)\]([^\[]*?)\[\/'.preg_quote($type).'\]/msi', $string, $matches);
			
			if(!empty($matches[1])){
				foreach($matches[3] as $k => $match_value){
					$replacement = self::$replacments[$type];
					
					if(!empty($matches[2][$k]) AND isset(self::$parameters[$type])){
						$parameter = self::$parameters[$type];
						
						$passed_param = trim(htmlspecialchars_decode($matches[2][$k]), ' ="');
						$passed_param = strip_tags($passed_param);
						
						//$passed_param = $this->cleanBBCode($passed_param);
						
						if(!empty($passed_param)){
							$parameter = str_replace('{param}', $passed_param, $parameter);
						}else{
							/*if(isset(self::$default_parameters[$type])){
								$parameter = str_replace('{param}', self::$default_parameters[$type], $parameter);
							}else{
								$parameter = str_replace('{param}', '', $parameter);
							}*/
							$parameter = str_replace('{param}', '', $parameter);
						}
						
						$replacement = str_replace('{param}', $parameter, $replacement);
					}else{
						//$replacement = str_replace('{param}', '', $replacement);
						if(isset(self::$default_parameters[$type])){
							$replacement = str_replace('{param}', self::$default_parameters[$type], $replacement);
						}else{
							$replacement = str_replace('{param}', '', $replacement);
						}
					}
					
					$replacement = str_replace('{value}', trim($matches[3][$k], ' ="'."\n\t\r"), $replacement);
					
					//pr($matches[0][$k]);
					//pr($replacement);
					
					$string = str_replace($matches[0][$k], $replacement, $string);
				}
			}
		}
		
		if($string == $lastver){
			return $string;
		}else{
			return $this->replaceBBCode($string, $string);
		}
	}
	
	function escapeCode($code){
		$fparams = $this->get('fparams');
		
		$code = trim($code, " \n\r");
		$code = str_replace("[", "&#91;", $code);
		$code = str_replace("]", "&#93;", $code);
		
		//$code = str_replace("\t", " ", $code);
		return '
		<div class="code-box">
			<div class="ui top attached tiny menu">
				<a class="item" onclick="copyToClipboard(this); return false;"><i class="copy icon"></i>'.rl('Copy to clipboard').'</a>
				<a class="item" onclick="expand_collapse_code(this); return false;"><i class="expand icon"></i>'.rl('Expand').'</a>
			</div>
			<div class="ui bottom attached segment'.($fparams->get('auto_collapse_code', 1) ? ' code-collapsed' : '').'" style="overflow:auto;">
				<pre class="cfu-code" style="overflow:visible; white-space:nowrap;">
				'.$code.'
				</pre>
			</div>
		</div>
		';
	}
	
	function parseCode($text){
		preg_match_all('/\[code\](.*?)\[\/code\]/ms', $text, $code_matches);
		$code_chunks = array();
		$code_count = 0;
		if(!empty($code_matches[1])){
			foreach($code_matches[1] as $c => $code){
				$new_code = $this->escapeCode($code);
				
				$text = str_replace($code_matches[0][$c], $new_code, $text);
			}
		}
		
		return $text;
	}
	
	function replaceURLs($text){
		//fix plain urls
		$URLRegex = '/(?:(?<!(\[\/url\]|\[\/url=))(\s|^))'; // No [url]-tag in front and is start of string, or has whitespace in front
		$URLRegex.= '(';                                    // Start capturing URL
		$URLRegex.= '(http?|https?|ftps?|ircs?):\/\/';            // Protocol
		$URLRegex.= '\S+';                                  // Any non-space character
		$URLRegex.= ')';                                    // Stop capturing URL
		$URLRegex.= '(?:(?<![[:punct:]])(\s|\.?$))/i';      // Doesn't end with punctuation and is end of string, or has whitespace after
		$text = preg_replace($URLRegex, "$2[url]$3[/url]$5", $text);
		return $text;
	}
	
	function replaceEmails($text){
		$fparams = $this->get('fparams');
		
		if($fparams->get('change_post_emails', 1)){
			//fix emails
			$EmailRegex = '/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/';
			preg_match_all($EmailRegex, $text, $email_matches);
			if(!empty($email_matches[0])){
				foreach($email_matches[0] as $email_match){
					$email_new = str_replace(array('@', '.'), array(' @[at] ', ' [dot] '), $email_match);
					$text = str_replace($email_match, $email_new, $text);
				}
			}
		}
		
		return $text;
	}
	
	function parseSmilies($text){
		$fparams = $this->get('fparams');
		
		$this->emodir = \G2\Globals::ext_url('chronoforums', 'front').'smilies'.DS.'default'.DS;
		$out = array(
			' <img width="15" height="15" title="Exclamation" alt=":!:" src="'.$this->emodir.'icon_exclaim.gif">',
			' <img width="15" height="15" title="Question" alt=":?:" src="'.$this->emodir.'icon_question.gif">',
			' <img width="15" height="15" title="Embarrassed" alt="oops" src="'.$this->emodir.'icon_redface.gif">',
			' <img width="15" height="15" title="Very Happy" alt=":D" src="'.$this->emodir.'icon_biggrin.gif">',
			' <img width="15" height="15" title="Smile" alt=":)" src="'.$this->emodir.'icon_smile.gif">',
			' <img width="15" height="15" title="Wink" alt=";)" src="'.$this->emodir.'icon_wink.gif">',
			' <img width="15" height="15" title="Sad" alt=":(" src="'.$this->emodir.'icon_sad.gif">',
			' <img width="15" height="15" title="Surprised" alt=":o" src="'.$this->emodir.'icon_surprised.gif">',
			' <img width="15" height="15" title="Shocked" alt=":shock:" src="'.$this->emodir.'icon_eek.gif">',
			' <img width="15" height="15" title="Confused" alt=":?" src="'.$this->emodir.'icon_confused.gif">',
			' <img width="15" height="15" title="Cool" alt="8-)" src="'.$this->emodir.'icon_cool.gif">',
			' <img width="15" height="15" title="Laughing" alt=":lol:" src="'.$this->emodir.'icon_lol.gif">',
			' <img width="15" height="15" title="Mad" alt=":x" src="'.$this->emodir.'icon_mad.gif">',
			' <img width="15" height="15" title="Razz" alt=":P" src="'.$this->emodir.'icon_razz.gif">',
			' <img width="15" height="15" title="Crying or Very Sad" alt=":cry:" src="'.$this->emodir.'icon_cry.gif">',
			' <img width="15" height="15" title="Evil or Very Mad" alt=":evil:" src="'.$this->emodir.'icon_evil.gif">',
			' <img width="15" height="15" title="Twisted Evil" alt=":twisted:" src="'.$this->emodir.'icon_twisted.gif">',
			' <img width="15" height="15" title="Rolling Eyes" alt=":roll:" src="'.$this->emodir.'icon_rolleyes.gif">',
			' <img width="15" height="15" title="Idea" alt=":idea:" src="'.$this->emodir.'icon_idea.gif">',
			' <img width="15" height="15" title="Arrow" alt=":arrow:" src="'.$this->emodir.'icon_arrow.gif">',
			' <img width="15" height="15" title="Neutral" alt=":|" src="'.$this->emodir.'icon_neutral.gif">',
			' <img width="15" height="15" title="Mr. Green" alt=":mrgreen:" src="'.$this->emodir.'icon_mrgreen.gif">',
			' <img width="17" height="17" title="Geek" alt=":geek:" src="'.$this->emodir.'icon_e_geek.gif">',
			' <img width="17" height="18" title="Uber Geek" alt=":ugeek:" src="'.$this->emodir.'icon_e_ugeek.gif">',

		);
		
		if((bool)$fparams->get('enable_smilies', 1) === true){
			$text = str_replace(self::$emotions, $out, $text);
		}
		
		return $text;
	}
	
}