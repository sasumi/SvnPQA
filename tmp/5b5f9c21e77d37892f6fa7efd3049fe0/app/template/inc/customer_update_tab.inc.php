<?php
use Lite\Core\Router;

$ctrl = Router::getController();
$act = Router::getAction();
$tmp = strtolower($ctrl.'/'.$act);
$navs = array();
$navs[strtolower($tmp)] = 'active';
$ref = $_GET['ref'];
$__customer_id = $_GET['customer_id'];
$__id = $_GET['id'];
?>

<ul class="frm-tab" id="update-nav-tab">
	<li class="<?php echo $navs[strtolower('Customer/showCustomerContactList')];?>">
		<a href="<?php echo $this->getUrl('Customer/showCustomerContactList', array('ref'=>$ref, 'customer_id'=>$__customer_id,'id'=> $__id));?>">联系人信息</a>
	</li>
	<li class="<?php echo $navs[strtolower('Customer/showCustomerQualificationList')];?>">
		<a href="<?php echo $this->getUrl('Customer/showCustomerQualificationList', array('ref'=>$ref, 'customer_id'=>$__customer_id,'id'=> $__id));?>">资质信息</a>
	</li>
	<li class="<?php echo $navs[strtolower('Customer/ShowCustomerFinancialList')];?>">
		<a href="<?php echo $this->getUrl('Customer/showCustomerFinancialList', array('ref'=>$ref, 'customer_id'=>$__customer_id,'id'=> $__id));?>">财务信息</a>
	</li>
</ul>
<style>
	#update-nav-tab {margin-bottom:5px;}
	#update-nav-tab li {padding:0}
	#update-nav-tab a {padding:5px 20px; display:block;;}
</style>