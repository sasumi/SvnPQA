<?php
use www\Auth;
use www\model\BusinessOrder;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\SampleProduceOrder;
use www\ViewBase;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleProduceOrder $sample_produce_order
 * @var BusinessOrder $business_order
 * @var CustomerContact $current_contact
 * @var Customer $customer
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
$defines = $sample_produce_order->getPropertiesDefine();
$sample_produce_order = $this->getData('sample_produce_order');
$business_order = $this->getData('business_order');
$customer = $this->getData('customer');
$current_contact = $this->getData('current_contact');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('BusinessOrder/addSampleProduceOrder',  array('id'=>$business_order->id));?>" class="frm" rel="async" method="post">
		<input type="hidden" name="business_order_id" value="<?php echo $business_order->id;?>">
		<input type="hidden" name="boss_head_employee_id" value="<?php echo Auth::instance()->getLoginUserId();?>">

		<table class="frm-tbl">
			<caption><?php echo $sample_produce_order->id? '更新' : '新增'?>样品生产单</caption>
			<tbody>
				<tr>
					<td class="col-label">生产单号</td>
					<td>
						<input type="text" name="order_no" class="txt" value="<?php echo $sample_produce_order->order_no ?: $business_order->order_no ;?>" readonly="readonly">
					</td>
				</tr>
				<tr>
					<td class="col-label">客户</td>
					<td>
						<input type="hidden" name="customer_id" class="txt" value="<?php echo $customer->id ;?>" >
						<input type="text"   name="customer_name" class="txt" value="<?php echo $customer->company_alias_name ;?>" disabled="disabled" readonly="readonly" >
					</td>
				</tr>
				<tr>
					<td class="col-label">联系人</td>
					<td>
						<input type="hidden" name="contact_id" class="txt" value="<?php echo $current_contact->id ;?>" >
						<input type="text"   name="contact_name" class="txt" value="<?php echo $current_contact->chinese_name ;?>" disabled="disabled" readonly="readonly">
					</td>
				</tr>
				<?php
				$this->walkDisplayProperties(function($alias, $val, $field)use($defines, $sample_produce_order){
					if(!in_array($field, array('order_no', 'contact_id', 'customer_id','create_time','update_time', 'state', 'business_order_id', 'boss_head_employee_id'))){
						echo '<tr>';
						echo '<td class="col-label">'.$alias.'</td>';
						echo '<td>'.$this->renderFormElement($sample_produce_order->$field, $field, $defines[$field], $sample_produce_order).'</td>';
						echo '</tr>';
					}
				}, $sample_produce_order);
				?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $sample_produce_order->id? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>
