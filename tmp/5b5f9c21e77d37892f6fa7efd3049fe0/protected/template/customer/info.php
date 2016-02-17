<?php
use Lite\Core\Router;
use function Lite\func\dump;
use function Lite\func\h;
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">客户信息</h2>
	<div class="content-warp">
		<h3 class="caption">客户基本信息<a href="<?php echo $this->getUrl('Customer/update', array('id'=>$customer->id));?>" rel="popup">更新</a></h3>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field)use($customer){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $customer);?>
		</dl>

        <h3 class="caption">客户联系人 <a href="<?=$this->getUrl('CustomerContact/update', array('customer_id'=>$customer->id));?>" rel="popup">新增</a></h3>
        <table class="data-tbl" data-empty-fill="1">
            <thead>
            <?php if($customer_contact_list):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<th>$alias</th>";
                        }
                    }, \Lite\func\array_first($customer_contact_list))?>
                    <th style="width:60px">操作</th>
                </tr>
            <?php endif;?>
            </thead>
            <tbody>
            <?php
            foreach($customer_contact_list as $contact):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<td>$value</td>";
                        }
                    }, $contact)?>
                    <td>
                        <a href="<?php echo $this->getUrl('CustomerContact/update', array('id'=>$contact->id));?>" rel="popup">编辑</a>
                        <a href="<?php echo $this->getUrl('CustomerContact/delete', array('id'=>$contact->id));?>" rel="async">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <h3 class="caption">客户资质 <a href="<?=$this->getUrl('CustomerQualification/update', array('customer_id'=>$customer->id));?>" rel="popup">新增</a></h3>
        <table class="data-tbl" data-empty-fill="1">
            <thead>
            <?php if($customer_qualification_list):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<th>$alias</th>";
                        }
                    }, \Lite\func\array_first($customer_qualification_list))?>
                    <th style="width:60px">操作</th>
                </tr>
            <?php endif;?>
            </thead>
            <tbody>
            <?php
            foreach($customer_qualification_list as $qualification):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<td>$value</td>";
                        }
                    }, $qualification)?>
                    <td>
                        <a href="<?php echo $this->getUrl('CustomerQualification/update', array('id'=>$qualification->id));?>" rel="popup">编辑</a>
                        <a href="<?php echo $this->getUrl('CustomerQualification/delete', array('id'=>$qualification->id));?>" rel="async">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <h3 class="caption">客户财务信息 <a href="<?=$this->getUrl('CustomerFinancial/update', array('customer_id'=>$customer->id));?>" rel="popup">新增</a></h3>
        <table class="data-tbl" data-empty-fill="1">
            <thead>
            <?php if($customer_financial_list):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<th>$alias</th>";
                        }
                    }, \Lite\func\array_first($customer_financial_list))?>
                    <th style="width:60px">操作</th>
                </tr>
            <?php endif;?>
            </thead>
            <tbody>
            <?php
            foreach($customer_financial_list as $financial):?>
                <tr>
                    <?php $this->walkDisplayProperties(function($alias, $value, $field){
                        if($field != 'customer_id'){
                            echo "<td>$value</td>";
                        }
                    }, $financial)?>
                    <td>
                        <a href="<?php echo $this->getUrl('CustomerFinancial/update', array('id'=>$financial->id));?>" rel="popup">编辑</a>
                        <a href="<?php echo $this->getUrl('CustomerFinancial/delete', array('id'=>$financial->id));?>" rel="async">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
	</div>
</div>
<style>
	.content-warp { max-width:1000px;}
	.sample-first-image {width:150px; overflow:hidden; padding:10px; background-color:#fff; text-align:center}
	.sample-first-image img {}
	.frm-tbl dd.col-label {width:100px; text-shadow:1px 1px 1px white;}
	.info-tbl {width:100%;}
	.info-tbl {box-shadow:0px 0px 4px #ccc}
	.info-tbl td { background-color:#fff; border-bottom:1px solid #eee}
	.info-tbl tbody th {background-color:#fafafa; width:100px; border-bottom:1px solid #eee}

	.info-list {width:100%; overflow:hidden; padding:1px 0 0 1px; margin:10px 0;}
	.info-list dt, .info-list dd {float:left; margin:-1px -1px 0 0; display:block; padding:5px 10px; width:60px; min-height:20px; line-height:20px; background-color:white; border:1px solid #ccc;}
	.info-list dt {color:gray;}
	.info-list dd { width:220px; margin-right:10px;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>