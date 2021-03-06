<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace GCore\Extensions\Chronoforums\Helpers;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Elements {
	var $view;
	function footer($data = array()){
		$topic = isset($data['topic']) ? $data['topic'] : null;
		$subscribed = isset($data['subscribed']) ? $data['subscribed'] : null;
		$forum = !empty($this->view->vars['forum']) ? $this->view->vars['forum']['Forum'] : array();
		?>
		<div class="container">
			<?php $this->breadcrumb(); ?>
		</div>
		<?php
	}

	function header($data = array()){
		$forum = !empty($this->view->vars['forum']) ? $this->view->vars['forum']['Forum'] : (!empty($this->view->vars['topic']['Forum']) ? $this->view->vars['topic']['Forum'] : array());
		$fparams = $this->view->vars['fparams'];
		$user = \GCore\Libs\Base::getUser();
		?>
		<div class="container">
			<?php $this->breadcrumb(); ?>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-lg-6 cfu-time">
							<?php if($fparams->get('show_datetime', 1) == 1): ?>
								<span class="text-primary pull-left"><i class="fa fa-fw- fa-clock-o fa-lg"></i>&nbsp;<?php echo \GCore\Libs\Date::_(l_('CHRONOFORUMS_DATE_FORMAT'), time()); ?></span>
							<?php endif; ?>
						</div>
						<div class="col-lg-6 pull-right cfu-search">
							<form action="<?php echo r_('index.php?ext=chronoforums&cont=forums'); ?>" method="post" name="searchform">
								<div class="input-group input-group-sm">
									<input type="hidden" name="cont" value="forums" />
									<input type="text" class="form-control" value="" size="20" id="cfu-search_keywords" name="skeywords" placeholder="<?php echo l_('CHRONOFORUMS_SEARCH_GLOBAL'); ?>..." />
									<span class="input-group-btn">
										<button class="btn btn-default" name="search_posts" type="submit" value=""><i class="fa fa-search"></i></button>
										<button class="btn btn-default reset" name="reset" type="submit" value=""><i class="fa fa-times"></i></button>
										<button type="button" class="btn btn-default" id="show_search_config">
											<i class="fa fa-cog"></i> <span class="caret"></span>
										</button>
										
									</span>
								</div>
								<div class="panel panel-default dropdown-menu gdropdown" id="cfu-search-config-content" style="display:none;">
									<div class="panel-heading"><?php echo l_('CHRONOFORUMS_SEARCH_SETTINGS'); ?></div>
									<div class="panel-body">
										<?php
										$options = explode(',', $fparams->get('search_start_from', '3m,6m,1y,2y'));
										$choices = array();
										$values = $fparams->get('search_start_from_value', '1y');
										foreach($options as $option){
											$time = substr($option, 1);
											$count = substr($option, 0, 1);
											switch($time){
												case 'm':
												$choices[$option] = sprintf(l_('CHRONOFORUMS_MONTHS_AGO'), $count);
												break;
												case 'y':
												$choices[$option] = sprintf(l_('CHRONOFORUMS_YEARS_AGO'), $count);
												break;
												case 'w':
												$choices[$option] = sprintf(l_('CHRONOFORUMS_WEEKS_AGO'), $count);
												break;
											}
										}
										?>
										<?php echo \GCore\Helpers\Html::formLine('search_age', array('type' => 'dropdown', 'label' => l_('CHRONOFORUMS_START_FROM'), 'options' => $choices, 'values' => $values, 'style' => 'width:auto;')); ?>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-lg-6 cfu-lists">
							<?php
								$class_noreplies = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'noreplies'){
									$class_noreplies = ' btn-warning active';
								}
								$class_new = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'new'){
									$class_new = ' btn-warning active';
								}
								$class_active = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'active'){
									$class_active = ' btn-warning active';
								}
								
								$class_featured = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'featured'){
									$class_featured = ' btn-warning active';
								}
								$class_unpublished = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'unpublished'){
									$class_unpublished = ' btn-warning active';
								}
							?>
							<div class="btn-group">
								<a class="btn btn-sm btn-default" title="<?php echo l_('CHRONOFORUMS_BOARD_INDEX'); ?>" href="<?php echo r_("index.php?ext=chronoforums"); ?>"><i class="fa fa-fw- fa-home fa-lg"></i></a>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_noreplies; ?>" title="<?php echo l_('CHRONOFORUMS_NOREPLIES_TOPIC_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=noreplies"); ?>"><?php echo l_('CHRONOFORUMS_NOREPLIES_TOPIC'); ?></a>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_new; ?>" title="<?php echo l_('CHRONOFORUMS_NEWPOSTS_TOPIC_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=new"); ?>"><?php echo l_('CHRONOFORUMS_NEWPOSTS_TOPIC'); ?></a>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_active; ?>" title="<?php echo sprintf(l_('CHRONOFORUMS_ACTIVE_TOPIC_DESC'), $fparams->get('active_topic_days', 7)); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=active"); ?>"><?php echo l_('CHRONOFORUMS_ACTIVE_TOPIC'); ?></a>
								<?php if((bool)$fparams->get('enable_topics_featured', 0)): ?>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_featured; ?>" title="<?php echo l_('CHRONOFORUMS_FEATURED_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=featured"); ?>"><?php echo l_('CHRONOFORUMS_FEATURED'); ?></a>
								<?php endif; ?>
								<?php if(\GCore\Libs\Authorize::authorized('\GCore\Extensions\Chronoforums\Chronoforums', 'modify_topics')): ?>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_unpublished; ?>" title="<?php echo l_('CHRONOFORUMS_UNPUBLISHED_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=unpublished"); ?>"><?php echo l_('CHRONOFORUMS_UNPUBLISHED'); ?></a>
								<?php endif; ?>
							</div>
						</div>
						<?php 
						$user = \GCore\Libs\Base::getUser();
						if(!empty($user['id'])):
						?>
						<div class="col-lg-6 cfu-user-tools">
							<?php
								$class_profile = ' btn-default';
								if(\GCore\Libs\Request::data('cont') == 'profiles' AND !\GCore\Libs\Request::data('act')){
									$class_profile = ' btn-info active';
								}
								$class_pm = ' btn-default';
								if(\GCore\Libs\Request::data('cont') == 'messages'){
									$class_pm = ' btn-info active';
								}
								$class_user = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'user'){
									$class_user = ' btn-info active';
								}
								$class_favorites = ' btn-default';
								if(\GCore\Libs\Request::data('list') == 'favorites'){
									$class_favorites = ' btn-info active';
								}
								$class_preferences = ' btn-default';
								if(\GCore\Libs\Request::data('act') == 'preferences'){
									$class_preferences = ' btn-info active';
								}
							?>
							<div class="btn-group pull-right">
								<a class="btn btn-sm<?php echo $class_profile; ?>" href="<?php echo r_(\GCore\Libs\Str::replacer($fparams->get('username_link_path', ''), array('id' => $user['id']))); ?>"><i class="fa fa-user fa-lg fa-fw"></i><?php echo $user[$fparams->get('display_name', 'username')];//echo l_('CHRONOFORUMS_MY_PROFILE'); ?></a>
								<?php if($fparams->get('enable_pm', 1)): ?>
									<a class="btn btn-sm gcoreTooltip<?php echo $class_pm; ?>" title="<?php echo l_('CHRONOFORUMS_PRIVATE_MESSAGING_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=messages"); ?>">
										<i class="fa fa-envelope fa-lg fa-fw"></i><?php //echo l_('CHRONOFORUMS_PM'); ?>
										<?php if(!empty($this->view->vars['new_pms'])): ?><span class="label label-danger"><?php echo $this->view->vars['new_pms']; ?></span><?php endif; ?>
									</a>
								<?php endif; ?>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_preferences; ?>" title="<?php echo l_('CHRONOFORUMS_BOARD_PREFERENCES'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=profiles&act=preferences&u=".$user['id']); ?>"><i class="fa fa-cogs fa-lg fa-fw"></i><?php //echo l_('CHRONOFORUMS_MY_TOPICS'); ?></a>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_user; ?>" title="<?php echo l_('CHRONOFORUMS_MY_TOPICS_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=user&u=".$user['id']); ?>"><i class="fa fa-comments fa-lg fa-fw"></i><?php //echo l_('CHRONOFORUMS_MY_TOPICS'); ?></a>
								<?php if((bool)$fparams->get('enable_topics_favorites', 0)): ?>
								<a class="btn btn-sm gcoreTooltip<?php echo $class_favorites; ?>" title="<?php echo l_('CHRONOFORUMS_FAVORITES_DESC'); ?>" href="<?php echo r_("index.php?ext=chronoforums&cont=forums&list=favorites"); ?>"><i class="fa fa-star fa-lg fa-fw"></i><?php //echo l_('CHRONOFORUMS_FAVORITES'); ?></a>
								<?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	
	function breadcrumb(){
		$forum = !empty($this->view->vars['forum']) ? $this->view->vars['forum']['Forum'] : (!empty($this->view->vars['topic']['Forum']) ? $this->view->vars['topic']['Forum'] : array());
		?>
		<div class="row">
			<ol class="breadcrumb">
				<li><i class="fa fa-fw- fa-home fa-lg"></i>&nbsp;<a accesskey="h" href="<?php echo r_('index.php?ext=chronoforums'); ?>"><?php echo l_('CHRONOFORUMS_BOARD_INDEX'); ?></a></li>
				<?php if(!empty($forum)): ?>
				<li class="active"><a href="<?php echo r_('index.php?ext=chronoforums&cont=forums&f='.$forum['id'].'&alias='.$forum['alias']); ?>"><?php echo $forum['title']; ?></a></li>
				<?php endif; ?>
			</ol>
		</div>
		<?php
	}
}