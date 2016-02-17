<?php use Lite\Core\Router;
use www\model\Sample;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');
$sample_info_list = $this->getData('sample_info_list');
?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<?php include $this->resolveTemplate('inc/suite_sample_update_tab.inc.php')?>
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl('SuiteSample/searchSample', array('suite_sample_id'=>$suite_sample_id))?>" class="btn" rel="popup">添加组成单件</a>
		</div>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<th style="width:100px;">图片</th>
				<th>货号</th>
				<th>名称</th>
				<th>尺寸</th>
				<th>重量</th>
				<th style="width:60px;">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php
			/** @var Sample $sample */
			foreach($sample_info_list as $sample): ?>
				<tr>
					<td><?php echo $this->displayField('image_url',$sample);?></td>
					<td><?php echo $sample->sample_no ;?></td>
					<td><?php echo $sample->chinese_name;?></td>
					<td><?php echo $sample->length,'x',$sample->width,'x',$sample->height;?></td>
					<td><?php echo $sample->weight ;?></td>
					<td>
						<a href="<?php echo $this->getUrl('SuiteSample/deleteMapSample', array('suite_sample_id'=>$suite_sample_id,'sample_id'=>$sample->id))?>" class="btn" rel="async">删除</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>