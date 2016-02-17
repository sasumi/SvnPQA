<?php
use www\model\SampleCategory;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleCategory $current_category
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
$defines = $current_category->getPropertiesDefine();
$all_categories = $this->getData('all_categories');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl($this->getController().'/update', array('id'=>$current_category->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $current_category->id? '更新' : '新增'?>样品分类</caption>
			<tbody>
				<tr>
					<td class="col-label">上级分类</td>
					<td>
						<select name="parent_id">
							<option value="0">顶级</option>
							<?php
							$disabled = false;
							$hit = false;
							foreach($all_categories as $k=>$c):
								if($c->id == $current_category->id){
									$hit = true;
									$disabled = true;
								} else if($hit && $c->tree_level > $current_category->tree_level){
									$disabled = true;
								}
								else if($hit && ($c->tree_level == $current_category->tree_level || $c->tree_level < $current_category->tree_level)){
									$hit = false;
									$disabled = false;
								} else {
									$hit = false;
									$disabled = false;
								}
							?>
							<option value="<?php echo $c->id;?>"
							    <?php echo $disabled ? 'disabled="disabled"' : '';?>
								<?php echo $c->id == $current_category->parent_id ?'selected':'';?>>
								<?php echo $c->name;?>
							</option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">名称</td>
					<td>
						<?php echo $this->renderFormElement($current_category->name, 'name', $defines['name'], $current_category);?>
					</td>
				</tr>
				<tr>
					<td class="col-label">状态</td>
					<td>
						<?php echo $this->renderFormElement($current_category->state, 'state', $defines['state'], $current_category);?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $current_category->id? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>