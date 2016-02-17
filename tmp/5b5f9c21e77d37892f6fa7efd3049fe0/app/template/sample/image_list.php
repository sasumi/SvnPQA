<h3 class="caption">图片列表
	<a href="<?php use www\model\SampleImage;

	echo $this->getUrl('SampleImage/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a>
</h3>
<?php if($sample_image_list):?>
	<ul class="image-thumb-list">
		<?php
		/** @var SampleImage $si */
		foreach($sample_image_list as $si):?>
			<li>
				<?php echo $this->displayField('image_url', $si);?>
				<span data-flag="source">
					<a href="<?php echo $this->buildUploadImage($si->image_url);?>" target="_blank">查看原图</a> |
					<a href="<?php echo $this->buildUploadImage($si->image_url);?>" download="<?php echo $si->image_url;?>">下载</a>
				</span>
				<a href="<?php echo $this->getUrl('SampleImage/delete', array('id'=>$si->id));?>" data-flag="delete" rel="async" data-confirm="确定要删除该图片">删除</a>
			</li>
		<?php endforeach;?>
	</ul>
<?php else:?>
	<div class="data-empty">没有图片</div>
<?php endif;?>