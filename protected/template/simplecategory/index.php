<?php
use Lite\Core\Router;
use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');
$nameController = Router::getController();
?>
	<div id="col-aside"><?php echo ViewBase::getSideMenu();?></div>
	<div id="col-main">
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl($nameController.'/update');?>" class="btn" rel="popup">添加<?php echo $catalog_name;?></a>
		</div>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<th style="width:30px">ID</th>
				<th>名称</th>
				<th class="text-center" style="width:50px">状态</th>
				<th style="width:120px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($data_list as $data):?>
				<tr>
					<td><?php echo $data->id;?></td>
					<td><?php echo $data->name;?></td>
					<td class="text-center">
						<span class="state-label <?php echo $data->state_css_class;?>">
							<?php echo $data->state_text;?>
						</span>
					</td>
					<td>
						<?php if($data->state == SimpleCategory_Model::STATE_DISABLE):?>
							<a href="<?php echo $this->getUrl($nameController.'/state', array('id'=>$data->id, 'state'=>SimpleCategory_Model::STATE_ENABLE))?>" rel="async">启用</a>
						<?php elseif($data->state == SimpleCategory_Model::STATE_ENABLE):?>
							<a href="<?php echo $this->getUrl($nameController.'/state', array('id'=>$data->id, 'state'=>SimpleCategory_Model::STATE_DISABLE))?>" rel="async">禁用</a>
						<?php endif;?>
						<a href="<?php echo $this->getUrl($nameController.'/update', array('id'=>$data->id))?>" rel="popup" title="更新<?php echo $catalog_name;?>">编辑</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $paginate; ?>
	</div>
<?php include __DIR__.'./../inc/footer.inc.php';?>