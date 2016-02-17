<?php use Lite\Core\Router;
use www\model\GlobalConf;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('Sample/update', array('sample_type'=>GlobalConf::SAMPLE_TYPE_SINGLE))?>" class="btn" rel="popup">新增单品</a>
		<a href="<?php echo $this->getUrl('Sample/update', array('sample_type'=>GlobalConf::SAMPLE_TYPE_SUITE))?>" class="btn" rel="popup">新增套件</a>
	</div>

	<?php include $this->resolveTemplate('crud/quick_search.inc.php');?>

	<?php if($data_list):?>
	<ul class="sample_list">
		<?php foreach($data_list as $sample):?>
		<li>
			<a href="<?php echo $this->getUrl('Sample/info', array('id'=>$sample->id))?>" class="image-thumb">
				<?php echo $this->getImg($this->buildUploadImage($sample->first_image_src));?>
			</a>
			<div class="st">
				<strong>
					<a href="<?php echo $this->getUrl('Sample/info', array('id' => $sample->id))?>">
						<?php echo $sample->sample_no;?>
					</a>
				</strong>
				<a href="<?php echo $this->getUrl('Sample/delete', array('id'=>$sample->id));?>" rel="async" data-confirm="确认删除该样品信息？">删除</a>
			</div>
			<span class="sample-type-flag">
				<?php echo $sample->sample_type == GlobalConf::SAMPLE_TYPE_SINGLE ? '单品' : '套件';?> |
				<?php echo $this->displayField('state', $sample);?>
			</span>
		</li>
		<?php endforeach;?>
	</ul>
	<?php else:?>
		<div class="data-empty">暂时没有数据</div>
	<?php endif?>

	<?php echo $paginate;?>
</div>
	<style>
		.sample_list { overflow:hidden; clear:both;}
		.sample_list .sample-type-flag {display:block; position:absolute; top:0; right:0; padding:2px 4px; background-color:rgba(255, 255, 255, 0.6); color:#0264AD;}
		.sample_list li {float:left; margin:0 15px 15px 0; overflow:hidden; position:relative;}
		.sample_list .image-thumb {width:150px; height:120px;  overflow:hidden; display:block; background-color:white; padding:10px;}
		.sample_list .st {padding:5px; text-align:right; background-color:rgba(255,255,255,0.6); margin-top:1px;}
		.sample_list .st strong {float:left;}
	</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>