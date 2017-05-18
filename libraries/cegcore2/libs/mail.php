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
class Mail {
	var $to = [];
	var $cc = [];
	var $bcc = [];
	var $subject = null;
	var $body = null;
	var $from_name = null;
	var $from_email = null;
	var $reply_name = null;
	var $reply_email = null;
	var $attachments = [];
	
	private function reset(){
		$this->to = [];
		$this->cc = [];
		$this->bcc = [];
		$this->subject = null;
		$this->body = null;
		$this->from_name = null;
		$this->from_email = null;
		$this->reply_name = null;
		$this->reply_email = null;
		$this->attachments = [];
	}
	
	public function to($to){
		if(is_array($to)){
			$this->to = array_merge($this->to, $to);
		}else{
			$this->to[] = $to;
		}
		return $this;
	}
	
	public function attachments($attachments){
		if(is_array($attachments)){
			$this->attachments = array_merge($this->attachments, $attachments);
		}else{
			$this->attachments[] = $attachments;
		}
		return $this;
	}
	
	public function subject($subject){
		$this->subject = $subject;
		return $this;
	}
	
	public function body($body){
		$this->body = $body;
		return $this;
	}
	
	public function from($from_email, $from_name){
		$this->from_name = $from_name;
		$this->from_email = $from_email;
		return $this;
	}
	
	public function replyTo($reply_email, $reply_name){
		$this->reply_name = $reply_name;
		$this->reply_email = $reply_email;
		return $this;
	}
	
	public function cc($cc){
		if(is_array($cc)){
			$this->cc = array_merge($this->cc, $cc);
		}else{
			$this->cc[] = $cc;
		}
		return $this;
	}
	
	public function bcc($bcc){
		if(is_array($bcc)){
			$this->bcc = array_merge($this->bcc, $bcc);
		}else{
			$this->bcc[] = $bcc;
		}
		return $this;
	}
	
	public function send(){
		$info = [
			'to' => $this->to,
			'cc' => $this->cc,
			'bcc' => $this->bcc,
			'subject' => $this->subject,
			'from_name' => $this->from_name,
			'from_email' => $this->from_email,
			'reply_name' => $this->reply_name,
			'reply_email' => $this->reply_email,
		];
		
		$result = $this->_send($info, $this->body, $this->attachments);
		
		$this->reset();
		
		return $result;
	}

	public function _send($info = array(), $message = '', $attachments = array()){
		if(!class_exists('PHPMailer')){
			require_once(\G2\Globals::get('FRONT_PATH').'vendors'.DS.'phpmailer'.DS.'PHPMailerAutoload.php');
		}

		$mail = new \PHPMailer();
		$mail->SMTPAutoTLS = false;
		$mail->CharSet = 'utf-8';
		//get recipients
		foreach((array)$info['to'] as $address){
			$mail->AddAddress(trim($address));
		}
		//subject
		$mail->Subject = $info['subject'];
		//reply to
		$reply_name = !empty($info['reply_name']) ? $info['reply_name'] : Config::get('mail.reply_name');
		$reply_email = !empty($info['reply_email']) ? $info['reply_email'] : Config::get('mail.reply_email');
		if(!empty($reply_name) AND !empty($reply_email)){
			$mail->AddReplyTo($reply_email, $reply_name);
		}
		//from
		$from_name = !empty($info['from_name']) ? $info['from_name'] : Config::get('mail.from_name');
		$from_email = !empty($info['from_email']) ? $info['from_email'] : Config::get('mail.from_email');
		$mail->SetFrom($from_email, $from_name);

		//set custom headers
		if(!empty($info['custom'])){
			foreach($info['custom'] as $k => $v){
				$mail->addCustomHeader($k.': '.$v);
			}
		}
		
		//set CC and BCC
		if(!empty($info['cc'])){
			foreach($info['cc'] as $k => $cc){
				$mail->AddCC($cc);
			}
		}
		if(!empty($info['bcc'])){
			foreach($info['bcc'] as $k => $bcc){
				$mail->AddBCC($bcc);
			}
		}

		if(Config::get('mail.method', 'phpmail') == 'smtp'){
			$mail->IsSMTP();
			if(Config::get('mail.smtp.username') AND Config::get('mail.smtp.password')){
				$mail->SMTPAuth = true;
			}
			if(Config::get('mail.smtp.security')){
				$mail->SMTPSecure = Config::get('mail.smtp.security');
			}
			$mail->Host       = Config::get('mail.smtp.host');
			$mail->Port       = Config::get('mail.smtp.port');
			$mail->Username   = Config::get('mail.smtp.username');
			$mail->Password   = Config::get('mail.smtp.password');
		}else if(Config::get('mail.smtp.method', 'phpmail') == 'sendmail'){
			$mail->IsSendmail();
		}
		
		if(!isset($info['type']) OR $info['type'] == 'html'){
			$mail->AltBody = strip_tags($message);//'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
			//$message = nl2br($message);
			//$mail->MsgHTML($message);
			$mail->Body = $message;
			$mail->IsHTML(true);
		}else{
			$mail->Body = $message;
			$mail->IsHTML(false);
		}
		
		$mail->SMTPDebug = (int) Config::get('mail.smtp.debug', 0);
		//attachments
		foreach((array)$attachments as $attachment){
			if(is_array($attachment) AND !empty($attachment['path'])){
				$attachment = array_merge(array('name' => basename($attachment['path']), 'type' => 'application/octet-stream', 'encoding' => 'base64'), $attachment);
				$mail->AddAttachment($attachment['path'], $attachment['name'], $attachment['encoding'], $attachment['type']);
			}else{
				$mail->AddAttachment($attachment);
			}
		}
		
		if(!$mail->Send()){
			\GApp::session()->flash('warning', 'Mailer Error: '.$mail->ErrorInfo);
			return false;
		}

		return true;
	}
}