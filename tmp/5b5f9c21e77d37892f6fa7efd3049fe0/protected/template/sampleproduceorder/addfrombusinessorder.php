<?php
use Lite\DB\Model;
use www\model\SampleProduceOrder;
use www\ViewBase;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleProduceOrder $order
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
$defines = $order->getPropertiesDefine();
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('SampleProduceOrder/update',  array('id'=>$order->id));?>" class="frm" rel="async" method="post">

		<table class="frm-tbl">
			<caption><?php echo $order->id? '更新' : '新增'?>样品生产单</caption>
			<tbody>
				<tr>
					<td class="col-label">生产单号</td>
					<td>
						<input type="text" name="order_no" class="txt" value="<?php echo $order->order_no ?: $business_order->order_no ;?>" readonly="readonly">
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
				$this->walkDisplayProperties(function($alias, $val, $field)use($defines, $order){
					if(!in_array($field, array('order_no', 'contact_id', 'customer_id','create_time','update_time'))){
						echo '<tr>';
						echo '<td class="col-label">'.$alias.'</td>';
						echo '<td>'.$this->renderFormElement($val, $field, $defines[$field], $order).'</td>';
						echo '</tr>';
					}
				}, $order);
				?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $order->id? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>
