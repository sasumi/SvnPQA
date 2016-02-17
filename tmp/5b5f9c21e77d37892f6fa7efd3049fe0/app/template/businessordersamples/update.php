<?php
use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');
$sample = $this->getData('sample');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<form action="<?=$this->getUrl('BusinessOrderSamples/update', array('id'=>$sample->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption>更新样品</caption>
			<tbody>
			<tr>
				<td class="col-label">货号</td>
				<td>
					<?php echo $sample->sample_no;?>
				</td>
			</tr>
			<tr>
				<td>样品图片</td>
				<td>
					<?php echo \www\ViewBase::displayField('sample_first_image_src',$sample);?>
				</td>
			</tr>
			<tr>
				<td class="col-label">包装方式</td>
				<td>
					<select name="sample_package_id" required="required">
						<?php foreacH(\www\model\Sample::findOneByPk($sample->sample_id)->package_list as $v):?>
							<option value ="<?php echo $v->id ;?>"><?php echo $v->pack_name;?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="col-label">数量</td>
				<td>
					<input type="number" name="sample_num" class="txt" value="<?php echo $sample->sample_num;?>"  step="1" min="1" required="required">
				</td>
			</tr>
			<tr>
				<td class="col-label">单价</td>
				<td>
					<input type="number" name="sample_unit_price" class="txt" value="<?php echo $sample->sample_unit_price;?>" step="0.01" min="0.01" required="required">
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="更新" class="btn"/>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<style>
	.fa-check {color:green;}
	.fa-close {color:orange}
	.image-thumb {width:80px; height:80px; float:left; margin:0 10px 10px 0;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>