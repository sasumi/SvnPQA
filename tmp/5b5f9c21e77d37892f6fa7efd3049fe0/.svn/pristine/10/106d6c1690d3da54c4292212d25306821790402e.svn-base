<?php
use www\model\SampleProduceOrderDeliverInfo;
use www\ViewBase;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleProduceOrderDeliverInfo $deliver_info
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
$deliver_info = $this->getData('deliver_info');
$logistics_company_list = $this->getData('logistics_company_list');
$defines = SampleProduceOrderDeliverInfo::meta()->getPropertiesDefine();
$produce_order_id = $this->getData('produce_order_id');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('SampleProduceOrder/deliver',  array('produce_order_id'=>$produce_order_id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $deliver_info->id? '更新' : '新增'?>邮寄信息</caption>
			<tbody>
				<tr>
					<td class="col-label">客户</td>
					<td>
						<input type="text" name="customer_name" value="<?php echo $deliver_info->customer_name;?>" class="txt">
					</td>
				</tr>
				<?php foreach(array('contact', 'phone', 'address', 'deliver_date', 'logistics_company','logistics_no', 'fee_type', 'fee', 'fee_currency_id') as $field):
				$define = $defines[$field];
				?>
				<tr>
					<td class="col-label"><?php echo $define['alias'];?></td>
					<td>
						<?php echo $this->renderFormElement($deliver_info->$field, $field, $define);?>
					</td>
				</tr>
				<?php endforeach;?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $deliver_info->id? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>
