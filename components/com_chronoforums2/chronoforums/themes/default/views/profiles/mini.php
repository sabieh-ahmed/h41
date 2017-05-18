<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php $this->view('views.profiles.basics', ['user' => $user['User'], 'profile' => $user['Profile']]); ?>