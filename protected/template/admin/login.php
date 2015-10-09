<?php include $this->getTemplate('inc/header.inc.php');?>
<form action="<?php echo $this->getUrl('admin/login')?>" class="frm well" style="width:400px" method="post" rel="async">
	<table class="frm-tbl">
		<caption>用户登录</caption>
		<tr>
			<td class="col-label">用户名</td>
			<td><input type="text" name="email" class="txt" value="test@test.com" id="email"/></td>
		</tr>
		<tr>
			<td class="col-label">密码</td>
			<td><input type="password" name="password" class="txt" value="123456"/></td>
		</tr>
		<tr>
			<td class="col-label"></td>
			<td>
				<input type="checkbox" name="auto_login" id="auto_login" value="1"/>
				<label for="auto_login">记住密码</label>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="登录系统" class="btn"><span style="color:red"><?=$msg?></span>
			</td>
		</tr>
	</table>
</form>
<?php include $this->getTemplate('inc/footer.inc.php');?>