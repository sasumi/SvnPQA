<?php
use Lite\Core\Config;

$PAGE_HEAD_HTML .= $this->getCss('login.css').'
<style>
#header {width:auto}
#login-frm {width:450px; margin:50px auto;}
#captcha-img { cursor:pointer; display:inline-block; margin-top:10px; vertical-align:middle}
</style>';
include $this->resolveTemplate('inc/header.inc.php');?>
<form action="<?php echo $this->getUrl('index/login')?>" class="frm well" id="login-frm" method="post" rel="async" onresponse="onresponse">
	<table class="frm-tbl">
		<caption>用户登录</caption>
		<tr>
			<td class="col-label">用户名</td>
			<td><input type="text" name="name" class="txt" value="admin"/></td>
		</tr>
		<tr>
			<td class="col-label">密码</td>
			<td><input type="password" name="password" class="txt" value="123456"/></td>
		</tr>
		<?php if($use_captcha):?>
		<tr>
			<td class="col-label">验证码</td>
			<td>
				<p><input type="text" name="captcha" class="txt"></p>
				<img alt="点击刷新验证码" title="点击刷新验证码" rel="refresh-captcha" id="captcha-img">
				<a href="javascript:;" rel="refresh-captcha">刷新</a>
			</td>
		</tr>
		<?php endif;?>
		<?php if(Config::get('app/login/allow_remember_in_frontend')):?>
		<tr>
			<td class="col-label"></td>
			<td>
				<input type="checkbox" name="auto_login" id="auto_login" value="1"/>
				<label for="auto_login">记住密码</label>
			</td>
		</tr>
		<?php endif;?>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="登录系统" class="btn"><span style="color:red"><?=$msg?></span>
			</td>
		</tr>
	</table>
</form>
<script>
	var onerror;
	var CAPTCHA_URL = '<?php echo $this->getUrl('index/captcha');?>';
	seajs.use(['jquery', 'ywj/net', 'ywj/msg'], function($, net, msg){

		window._msg = msg;
		$('#login-frm input[name=name]').focus();

		var ud = function(){
			var s = net.mergeCgiUri(CAPTCHA_URL, {__:Math.random()});
			$('#captcha-img').attr('src', s);
		};

		window.onresponse = function(rsp){
			if(rsp.code == 0){
				msg.show(rsp.message, 'succ');
				if(rsp.jump_url){
					location.replace(rsp.jump_url);
				} else {
					location.reload();
				}
				return;
			}
			msg.show(rsp.message, 'err',1);
			if(rsp.data && rsp.data == 'captcha'){
				var $cap_input = $('input[name=captcha]');
				$cap_input[0].select($cap_input[0]);
				$cap_input.focus();
				ud();
			}
		};
		$('[rel=refresh-captcha]').click(function(){
			ud();
			return false;
		});
		ud();
	});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>