<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<?php $current_controller = \Lite\Core\Router::getController();?>
	<div id="col-aside">
		<?php echo ViewBase::getSideMenu();;?>
	</div>
	<div id="col-main">
		<form action="<?=$this->getUrl($current_controller.'/update', array('id'=>$data->id));?>" class="frm" rel="async" method="post">
			<table class="frm-tbl">
				<caption><?php echo $data ? '更新' : '新增';?>分类</caption>
				<tbody>
				<tr>
					<td class="col-label"><?php echo $catalog_name;?>名称</td>
					<td>
						<input type="text" name="name" class="txt" value="<?=$data->name;?>"/>
					</td>
				</tr>
				<tr>
					<td class="col-label">状态</td>
					<td>
						<label>
							<input type="radio" name="state" value="0" <?php if(!$data->id || !$data->state):?>checked="checked"<?php endif;?>>启用
						</label>
						<label>
							<input type="radio" name="state" value="1" <?php if($data->state):?>checked="checked"<?php endif;?>>禁用
						</label>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?=$data ? '保存修改' : '新增分类'?>" class="btn" />
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
<?php include __DIR__.'./../inc/footer.inc.php';?>