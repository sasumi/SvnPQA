<?php use SvnPQA\Model\Employee;
use SvnPQA\ViewBase;
include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('employee/update');?>" class="btn" rel="popup">新增员工</a>
	</div>
	<form class="search-frm well" action="<?php echo $this->getUrl('employee');?>" method="get">
		<div class="frm-item">
			<label>
				<input class="txt" type="text" name="kw" value="<?php echo $search['kw'];?>" placeholder="关键字"/>
			</label>
		</div>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl('employee');?>" class="btn">重置</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<caption>员工列表</caption>
		<thead>
		<tr>
			<th>工号</th>
			<th>名称</th>
			<th>工资形式</th>
			<th>负责流程</th>
			<th>身份证号码</th>
			<th>生日</th>
			<th>住址</th>
			<th>电话</th>
			<th>紧急联系电话</th>
			<th>入职时间</th>
			<th>离职时间</th>
			<th style="width:30px">状态</th>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($employee_list?:array() as $employee):?>
			<tr>
				<td><?php echo $employee->employee_no;?></td>
				<td><?php echo $employee->name;?></td>
				<td><?php echo $employee->pay_type_text;?></td>
				<td><?php echo $employee->work_flow_type_text;?></td>
				<td><?php echo $employee->id_card_number;?></td>
				<td><?php echo $employee->birthday ? date('Y-m-d', $employee->birthday):'';?></td>
				<td><?php echo $employee->address;?></td>
				<td><?php echo $employee->tel;?></td>
				<td><?php echo $employee->urgent_tel;?></td>
				<td><?php echo $employee->entry_time ? date('Y-m-d',$employee->entry_time) : '';?></td>
				<td><?php echo $employee->leave_time ? date('Y-m-d',$employee->leave_time) : '';?></td>
				<td><?php echo $employee->state_text;?></td>
				<td>
					<a href="<?php echo $this->getUrl('employee/state', array('state'=>($employee->state == Employee::STATE_ENABLE ? Employee::STATE_DISABLE : Employee::STATE_ENABLE), 'id'=>$employee->id));?>" rel="async">禁用</a>
					<a href="<?php echo $this->getUrl('employee/update', array('id'=>$employee->id));?>" rel="popup">更新</a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate; ?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>