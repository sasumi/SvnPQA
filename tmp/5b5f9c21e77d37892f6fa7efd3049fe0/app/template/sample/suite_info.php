<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\Sample;
use www\model\SampleMould;
use www\ViewBase;
use function Lite\func\array_first;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var ModelInterface|Model $model_instance
 * @var Sample $sample
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');

$sample = $this->getData('sample');
$defines = $sample->getPropertiesDefine();
$sample_list = $sample->sample_list;
$sample_image_list = $this->getData('sample_image_list');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">套件样品信息<a href="<?php echo $this->getUrl('Sample');?>">返回列表</a></h2>
	<div class="content-fix-width">
		<?php include 'image_list.php';?>
		<h3 class="caption">基本信息
			<a href="<?php echo $this->getUrl('Sample/update', array('id'=>$sample->id));?>" rel="popup">更新</a>
			<a href="<?php echo $this->getUrl('Sample/delete', array('id'=>$sample->id));?>" rel="async" data-confirm="确认删除该样品信息？">删除</a>
		</h3>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field)use($sample){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $sample);?>
		</dl>

		<h3 class="caption">单品列表 <a href="<?=$this->getUrl('Sample/searchSingleSample', array('id'=>$sample->id));?>" rel="popup-refresh">新增</a></h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<?php if($sample_list):?>
				<tr>
					<th>图片</th>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<th>$alias</th>";
						}
					}, array_first($sample_list));?>
					<th style="width:60px">操作</th>
				</tr>
			<?php endif;?>
			</thead>
			<tbody>
			<?php
			/** @var SampleMould $sample */
			foreach($sample_list as $item):?>
				<tr>
					<td><?php echo $this->displayField('first_image_src', $item);?></td>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<td>$value</td>";
						}
					}, $item)?>
					<td>
						<a href="<?php echo $this->getUrl('Sample/removeSingleSample', array('id'=>$sample->id, 'single_sample_id'=>$item->id));?>" rel="async">取消</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

		<?php include 'package_list.php';?>
	</div>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>