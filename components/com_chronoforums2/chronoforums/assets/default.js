function expand_collapse_code(e){
	var $link = jQuery(e);
	if($link.closest('.code-box').find('.segment').first().hasClass('code-collapsed')){
		$link.closest('.code-box').find('.segment').first().removeClass('code-collapsed');
		$link.text($link.data('collapse'));
	}else{
		$link.closest('.code-box').find('.segment').first().addClass('code-collapsed');
		$link.text($link.data('expand'));
	}
}

function copyToClipboard(e) {
	var $link = jQuery(e);
	
	var $temp = jQuery("<input>");
	jQuery("body").append($temp);
	
	$temp.val($link.closest('.code-box').find('code').text()).select();
	document.execCommand("copy");
	$temp.remove();
	
	$link.transition('flash');
}