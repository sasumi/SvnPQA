<?php
//todo 这里的系统入口判断的是单个的权限，并不是整个系统的，因此会出现：如果入口没有权限， 那么系统入口的权限也就没有了。
use www\Auth;
use function Lite\func\h;

$login_user = Auth::instance()->getLoginInfo();
?>
<div id="welcome">
	<?php
	if($login_user):?>
	<span class="user">
        <?php echo h($login_user['name']);?>
    </span>
	<div class="user-panel">
		<div class="avatar-wrap">
			<?php echo $this->getImg($login_user['photo'] ?: 'default_avatar.png', array('max-width'=>90, 'max-height'=>90));?>
		</div>
		<div class="user-pannel-ext">
			<p style="min-height:60px"><?php echo h($login_user['name']);?></p>
			<p>
				<a href="<?php echo $this->getUrl('user/updatePassword');?>" rel="popup">修改密码</a>
				<span class="sep">|</span>
				<a href="<?php echo $this->getUrl('index/logout');?>" rel="async">注销</a>
			</p>
		</div>
	</div>
<?php else:?>
	<a href="<?php echo $this->getUrl('index/login');?>" class="login-link">登录系统</a>
<?php endif;?>
</div>
