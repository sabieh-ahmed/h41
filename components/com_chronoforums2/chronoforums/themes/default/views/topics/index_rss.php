<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
if(!empty($topics)){
	echo '<rss version="2.0">'."\n";
		echo "\t".'<channel>'."\n";
			foreach($topics as $topic){
				echo "\t"."\t".'<item>'."\n";
					echo "\t"."\t"."\t".'<title>'.$topic['Topic']['title'].' - '.$topic['LastPostUser']['username'].'</title>'."\n";
					echo "\t"."\t"."\t".'<link>'.r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['Topic']['id']).'#'.$topic['LastPost']['id'], false, true).'</link>'."\n";
				echo "\t"."\t".'</item>'."\n";
			}
		echo "\t".'</channel>'."\n";
	echo '</rss>';
}
?>