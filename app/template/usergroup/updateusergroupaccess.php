<?php
use Lite\Core\Config;
use function Lite\func\dump;
use function Lite\func\is_assoc_array;

$cdn_url = Config::get('app/cdn_url');
$PAGE_HEAD_HTML .= $this->getCss($cdn_url.'ywj/ui/backend/access.css');
$PAGE_HEAD_HTML .= <<<EOT
<style>
	#col-main .frm {width:auto}
	.access-list-wrap {border:1px solid gray;  float:left; margin-right:10px; min-width:300px;}
	.access-list-wrap h2 {font-size:14px;; font-weight:normal; background-color:#fafafa; padding:5px 10px; color:gray;}
	#access-ctrl-list {padding:10px;}
	#access-ctrl-list h3 {padding-bottom:5px; font-size:14px;}
	#access-ctrl-list .access-list {}
	.access-black-list {border-color:gray;}
	.access-black-list h2 {background-color:gray; color:white;}
	.submit-fieldset {padding:10px 5px;}
	.root-item .access-name {background-color:#FEE; color:red;}
</style>
EOT;
include $this->resolveTemplate('inc/header.inc.php');

function show_check_box($check_state=0){
	$s = $check_state == 0 ? 'checkbox-unchecked' : ($check_state == 1 ? 'checkbox-checked' : 'checkbox-partial');
	return '<span class="touch-icon checkbox-icon '.$s.'">checkbox</span>';
}

function show_collapse($expand=false){
	return '<span class="touch-icon collapse-icon '.($expand ? 'collapse-expand':'').'">collapse</span>';
}

function show_access($k, $v, $is_mod=false, $black=false){
	$html = '';
	if(is_assoc_array($v)){
		$html .= '<li class="'.($is_mod ? 'access-mod':'').'"><label>'.show_collapse(true).show_check_box(2).'<span class="access-fold">'.$k.'</span></label>';
		$html .= '<ul class="access-expand">';
		foreach($v as $k2=>$v2){
			$html .= show_access($k2, $v2, null, $black);
		}
		$html .= '</ul>';
		$html .= '</li>';
	} else {
		$n = $black ? 'act_bids' : 'act_wids';
		$cls = $v[1] == '*' ? 'root-item': '';
		$html .= '<li class="'.$cls.'"><label>'.
			'<input type="checkbox" name="'.$n.'[]" value="'.$v[0].'" '.($v[2]?'checked="checked"':'').'/>'.
			'<span class="access-name">'.$k.'</span><span class="access-uri">'.$v[1].'</span>'.
			'</label></li>';
	}
	return $html;
}
?>
<div id="col-aside"><?php echo $this->getSideMenu(); ?></div>
<div id="col-main">
    <form action="<?= $this->getUrl('UserGroup/updateUserGroupAccess', array('user_group_id' => $user_group_id)); ?>" class="frm" rel="async"  method="post">
        <table class="frm-tbl">
	        <caption>更新用户组权限</caption>
            <tbody>
	            <tr>
	                <td class="col-label">用户组</td>
	                <td>
		                <select name="user_group_id" required="required" disabled="disabled">
			                <option value="">请选择用户组</option>
			                <?php foreach($user_group_list as $ug):?>
			                <option value="<?php echo $ug->id;?>"
				                <?php echo $ug->id == $user_group_id ? 'selected':'';?>>
				                <?php echo $ug->name;?>
			                </option>
			                <?php endforeach;?>
		                </select>
	                </td>
	            </tr>
	            <tr>
		            <td class="col-label">权限</td>
		            <td>
			            <div class="access-list-wrap access-white-list">
				            <h2>白名单</h2>
				            <div id="access-ctrl-list">
					            <ul class="access-list">
						            <?php foreach($auth_list[0] as $k=>$v):?>
									<?php echo show_access($k, $v, true);?>
						            <?php endforeach;?>
					            </ul>
				            </div>
			            </div>
			            <div class="access-list-wrap access-white-list">
				            <h2>黑名单</h2>
				            <div id="access-ctrl-list">
					            <ul class="access-list">
						            <?php foreach($auth_list[1] as $k=>$v):?>
							            <?php echo show_access($k, $v, true);?>
						            <?php endforeach;?>
					            </ul>
				            </div>
			            </div>
		            </td>
	            </tr>
	            <tr>
		            <td class="col-label"></td>
	                <td class="col-action">
	                    <input type="submit" value="提交" class="btn btn-primary">
	                </td>
	            </tr>
            </tbody>
        </table>
    </form>
</div>
<style>
	input[type=submit][disabled] {display: none}
	.access-list-wrap { background-color:#fff; box-shadow:1px 1px 5px #ccc; border:1px solid #CDCDCD; width:400px;}
</style>

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
		//$('.access-mod .collapse-icon').trigger('click');
		pc('.access-mod');
	});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php'); ?>
