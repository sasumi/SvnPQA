<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo ViewBase::getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('user/update', array('id'=>$data->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $data->id ? '更新' : '新增'?>用户</caption>
			<tbody>
			<tr>
				<td class="col-label" style="width:80px">用户名</td>
				<td>
					<?php echo $data->name;?>
				</td>
			</tr>
			<tr>
				<td class="col-label">密码</td>
				<td>
					<input type="password" name="password" class="txt" value="">
				</td>
			</tr>
			<tr>
				<td class="col-label">重复密码</td>
				<td>
					<input type="password" name="password" class="txt" value="">
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="修改密码" class="btn" />
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>