<?php use SvnPQA\Model\User;
use SvnPQA\ViewBase;

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
				<td class="col-label">用户名</td>
				<td>
					<input type="text" name="name" class="txt" value="<?php echo $data->name;?>">
				</td>
			</tr>
			<?php if(!$data->id):?>
			<tr>
				<td class="col-label">密码</td>
				<td>
					<input type="password" name="password" class="txt" value="">
				</td>
			</tr>
			<?php endif;?>
			<tr>
				<td class="col-label">真实名称</td>
				<td>
					<input type="text" name="real_name" class="txt" value="<?php echo $data->real_name;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">状态</td>
				<td>
					<?php foreach(User::$state_list as $s=>$n):?>
						<label>
							<input type="radio" name="state" value="<?php echo $s;?>" <?php echo $data->state == $s ? 'checked':'';?>>
							<?php echo $n;?>
						</label>
					<?php endforeach;?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="保存" class="btn" />
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>