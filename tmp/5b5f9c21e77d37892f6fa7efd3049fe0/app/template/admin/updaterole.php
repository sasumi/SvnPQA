<?php

include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('admin/updateRole', array('id'=>$role->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $role->id ? '保存修改' : '新增角色' ?></caption>
			<tr>
				<td class="col-label" style="width:100px">角色名称：</td>
				<td><input type="text" name="name" class="txt" value="<?php echo $role->name; ?>"/></td>
			</tr>
			<tr>
				<td class="col-label">开放权限：</td>
				<td>
					<textarea name="allow" cols="60" rows="5" class="txt"><?php echo $role->allow; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="col-label">禁止权限：</td>
				<td>
					<textarea name="deny" cols="60" rows="5" class="txt"><?php echo $role->deny ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="col-label">缺省权限类型：</td>
				<td>
					<select name="default_type" class="txt">
						<?php foreach ($default_type_list as $val => $txt): ?>
						<option value="<?php echo $val ?>" <?php echo $role->default_type == $val ? 'selected' : '' ?>><?php echo $txt ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" value="<?php echo $role->id ? '保存修改' : '新增角色' ?>" class="btn">
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>