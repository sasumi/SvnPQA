<?php
//todo 这里的系统入口判断的是单个的权限，并不是整个系统的，因此会出现：如果入口没有权限， 那么系统入口的权限也就没有了。
use function Lite\func\h;
use SvnPQA\Model\Access;
use SvnPQA\ViewBase;

$login_user = Access::instance()->getLoginInfo();
$login_user = array(
	'id'=>'xx',
	'name' => 'Administrator',
	'department_path' => array()
);
?>
<div id="welcome">
	<?php
	if($login_user):?>
	<span class="user">
        <?php echo h($login_user['name']);?>
    </span>
	<div class="user-panel">
		<div class="avatar-wrap">
			<?php echo ViewBase::getImg($login_user['photo'] ?: ViewBase::getImgUrl('default_avatar.png'), array('max-width'=>90, 'max-height'=>90));?>
		</div>
		<div class="user-pannel-ext">
			<p><?php echo h($login_user['id']);?></p>
			<p><?php echo h($login_user['name']);?></p>
			<p>
				<span><?php echo join('</span> / <span>',$login_user['department_path']);?></span>
				/
				<span><?php echo h($login_user['title']);?></span>
			</p>
			<p>
				<a href="<?php echo ViewBase::getUrl('user/updatePassword');?>" rel="popup">修改密码</a>
				<span class="sep">|</span>
				<a href="<?php echo ViewBase::getUrl('user/logout');?>">注销</a>
			</p>
		</div>
	</div>
<?php else:?>
	<a href="<?php echo ViewBase::getUrl('user/login');?>" rel="popup" data-width="400">登录系统</a>
<?php endif;?>
</div>
