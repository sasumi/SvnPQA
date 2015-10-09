<?php use Lite\Core\Router;
use function Lite\func\h;
use SvnPQA\Model\User;
use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo ViewBase::getSideMenu();?>
	</div>
	<div id="col-main">
		<form action="<?=$this->getUrl($current_controller.'/update', array('id'=>$data->id));?>" class="frm" rel="async" method="post">
			<table class="frm-tbl">
				<caption><?php echo $data ? '更新' : '新增';?><?php echo $catalog_name;?></caption>
				<tbody>
				<tr>
					<td class="col-label">上级<?php echo $catalog_name;?></td>
					<td>
						<select name="parent_id">
							<option value="0">顶级<?php echo $catalog_name;?></option>
							<?php foreach($category_list as $cat):?>
								<option value="<?=$cat->id;?>" <?php echo ($cat->id == $data->id || ($cat->level >= 1 && !$cat::ENABLE_DEEP_LEVEL) || $cat->is_del) ? 'disabled' : '';?> <?php echo $cat->id ==  $data->parent_id ? 'selected':'';?>>
								<?=$cat->deep_name;?>
								<?php echo $cat->id == $data->id ? '(当前'.$catalog_name.')':'';?>
							</option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">部门负责人</td>
					<td>
						<select name="manager_id">
							<?php $user_list = User::find('state=?',User::STATE_ENABLE)->all();?>
							<?php foreach($user_list as $user):?>
							<option value="<?php echo $user->id;?>" <?php echo $user->id == $data->manager_id ? 'selected':'';?>><?php echo $user->name;?></option>
							<?php endforeach?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">名称</td>
					<td>
						<input type="text" name="name" class="txt" value="<?=$data->name;?>"/>
					</td>
				</tr>
				<tr>
					<td class="col-label">描述</td>
					<td>
						<textarea name="description" cols="30" rows="3" class="small-txt txt"><?php echo h($data->description);?></textarea>
					</td>
				</tr>
				<tr>
					<td class="col-label">状态</td>
					<td>
						<label>
							<input type="radio" name="is_del" value="0" <?php if(!$data->id || !$data->is_del):?>checked="checked"<?php endif;?>>启用
						</label>
						<label>
							<input type="radio" name="is_del" value="1" <?php if($data->is_del):?>checked="checked"<?php endif;?>>禁用
						</label>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?=$data ? '保存修改' : '新增'?><?php echo $catalog_name;?>" class="btn" />
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
<?php include __DIR__.'./../inc/footer.inc.php';?>