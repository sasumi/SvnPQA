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
			<caption>部门列表</caption>
			<thead>
			<tr>
				<th style="width:30px">ID</th>
				<th><?php echo $catalog_name;?>标题</th>
				<th style="width:100px">部门负责人</th>
				<th style="width:100px">上级<?php echo $catalog_name;?></th>
				<th style="width:150px">描述</th>
				<th style="width:30px">状态</th>
				<th style="width:70px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($data_list as $data):?>
				<tr <?php if($data->is_del):?> class="danger"<?php endif;?>>
					<td><?php echo $data->id;?></td>
					<td><?php echo $data->deep_name;?></td>
					<td><?php echo $data->manager->name;?></td>
					<td><?php echo $data->parent_category;?></td>
					<td><?php echo $data->description;?></td>
					<td>
						<span class="state-label <?php echo $data->state_css_class;?>">
							<?php echo $data->state_text;?>
						</span>
					</td>
					<td>
						<dl class="drop-list">
							<dt>
								<a href="<?php echo $this->getUrl($nameController.'/update', array('id'=>$data->id))?>" rel="popup" title="更新<?php echo $catalog_name;?>信息">编辑</a>
							</dt>
							<dd>
								<a href="<?php echo $this->getUrl($nameController.'/state', array('id'=>$data->id, 'state'=>!$data->is_del))?>" rel="async">
									<?php echo $data->is_del ? '启用' : '禁用'?>
								</a>
							</dd>
						</dl>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $paginate; ?>
	</div>
<?php include __DIR__.'./../inc/footer.inc.php';?>