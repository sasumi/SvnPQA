<?php use Lite\Core\Router;
use www\model\GlobalConf;
use function Lite\func\dump;
use function Lite\func\h;

$cost_data = $this->getData('cost_data');
$sample_info = $this->getData('sample_info');
$technic_flow_list = $this->getData('technic_flow_list');
$current_controller = Router::getController();

include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>

<div id="col-main">
	<form action="<?=$this->getUrl($current_controller.'/update', array('id'=>$sample_info->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $sample_info->id ? '更新' : '新增';?>样品工价</caption>
			<tbody>
				<tr>
					<td class="col-label">货号</td>
					<td>
						<input type="text" name="sample_id" value="<?php echo $sample_info->id;?>"
						       class="txt"
						       rel="sample-input"
						       data-sample-no="<?php echo $sample_info->sample_no;?>"
						       data-sample-type="<?php echo GlobalConf::SAMPLE_TYPE_SINGLE;?>"
						       data-onstart="onstart"
						       data-onsuccess="onsuccess">
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top;">工序</td>
					<td>
						<ul class="work-flow-list">
							<?php foreach($technic_flow_list as $flow_id=>$n):?>
							<li <?php echo isset($cost_data[$flow_id]) ? '' : 'class="work-flow-disabled"';?>>
								<p><?php echo $n;?></p>
								<input type="number" min="0" step="0.01" name="price_list[<?php echo $flow_id;?>]"
								       data-flow-id="<?php echo $flow_id;?>"
								       <?php echo isset($cost_data[$flow_id]) ? '' : 'disabled="disabled"';?>
								       value="<?php echo $cost_data[$flow_id]['price'];?>"
								       class="txt">
							</li>
							<?php endforeach;?>
						</ul>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $sample_info->id ? '保存修改' : '新增'?>" class="btn" disabled="disabled"/>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<style>
	.work-flow-list li {float:left; padding:0 10px 10px 0; width:60px;}
	.work-flow-list .work-flow-disabled {color:#ddd;}
	.work-flow-list input.txt[type=number] {width:50px; text-align:center; margin-top:3px;}
	.work-flow-list input.txt[type=number][disabled] {color:#ccc; border-color:#eee;}
</style>

<script>
	seajs.use(['jquery'], function($){
		var $list = $('.work-flow-list');

		window['onstart'] = function(){
			$list.find('li').addClass('work-flow-disabled');
			$list.find('input').attr('disabled', 'disabled');
		};

		window['onsuccess'] = function(sample){
			if(sample.extend_info && sample.extend_info.technic_flow_id_list){
				var ids = sample.extend_info.technic_flow_id_list.split(',');
				for(var i=0; i<ids.length; i++){
					var $i = $list.find('input[data-flow-id='+ids[i]+']');
					$i.parent().removeClass('work-flow-disabled');
					$i.attr('disabled', false);
				}
			}
			$list.find('input[type=submit]').attr('disabled', 'disabled');
		}
	})
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>