<?php
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
?>
<?php
	$classes = [];
	if(\G2\Globals::get('app')){
		$classes[] = 'semanticui-body';
		$classes[] = 'G2-'.\G2\Globals::get('app');
	}
	$app = \GApp::instance();
	$classes[] = $app->extension;
	$classes[] = $app->controller;
	$classes[] = $app->action;
?>
<div class="<?php echo implode(' ', $classes); ?>">
	{VIEW}
</div>