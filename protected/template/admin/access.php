<?php
use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');
echo $this->getCss('access.css');

function show_check_box($check_state=0){
	$s = $check_state == 0 ? 'checkbox-unchecked' : ($check_state == 1 ? 'checkbox-checked' : 'checkbox-partial');
	return '<span class="touch-icon checkbox-icon '.$s.'">checkbox</span>';
}

function show_collapse($expand=false){
	return '<span class="touch-icon collapse-icon '.($expand ? 'collapse-expand':'').'">collapse</span>';
}

function show_access($k, $v, $is_mod=false){
	$html = '';
	if(is_array($v)){
		$html .= '<li class="'.($is_mod ? 'access-mod':'').'"><label>'.show_collapse(true).show_check_box(2).'<span class="access-fold">'.$k.'</span></label>';
		$html .= '<ul class="access-expand">';
		foreach($v as $k2=>$v2){
			$html .= show_access($k2, $v2);
		}
		$html .= '</ul>';
		$html .= '</li>';
	} else {
		$html .= '<li><label><input type="checkbox" name="" '.(rand(0,1)?'checked="checked"':'').'/><span class="access-name">'.$k.'</span><span class="access-uri">'.$v.'</span></label></li>';
	}
	return $html;
}
?>
<div id="col-aside">
	<?php echo ViewBase::getSideMenu()?>
</div>
<div id="col-main">
	<ul class="access-list">
		<?php foreach($access_alias_list as $k=>$v):?>
		<?php echo show_access($k, $v, true);?>
		<?php endforeach;?>
	</ul>
</div>

<script>
seajs.use(['jquery', 'ywj/partialcheck', 'ywj/util'], function($, pc, util){
	$('.collapse-icon').click(function(){
		var li = util.findParent(this, 'li');
		var ul = $('ul:first', li);
		var toExp = !(ul.hasClass('access-expand'));
		$(this)[toExp ? 'addClass' : 'removeClass']('collapse-expand');
		ul[toExp ? 'addClass' : 'removeClass']('access-expand');
		ul[toExp ? 'removeClass' : 'addClass']('access-collapse');
		return false;
	});
	pc('.access-mod');
});
</script>
<?php include $this->getTemplate('inc/footer.inc.php');?>