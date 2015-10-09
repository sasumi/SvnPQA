<?php use SvnPQA\Model\Employee;
use SvnPQA\Model\User;
use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo ViewBase::getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('employee/update', array('id'=>$data->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $data->id ? '更新' : '新增'?>员工</caption>
			<tbody>
			<tr>
				<td class="col-label">工号</td>
				<td>
					<input type="text" name="employee_no" class="txt" value="<?php echo $data->employee_no;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">名称</td>
				<td>
					<input type="text" name="name" class="txt" value="<?php echo $data->name;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">工资形式</td>
				<td>
					<select name="" id="">
					<?php foreach(Employee::$pay_type_list as $k=>$pay_type):?>
						<option value="<?php echo $k; ?>" <?php echo $k==$employee->pay_type ? 'selected':'';?>><?php echo $pay_type;?></option>
					<?php endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="col-label">负责流程</td>
				<td>
					<select name="work_flow_type" id="">
						<option value="1">ceshi</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="col-label">身份证号码</td>
				<td>
					<input type="text" name="id_card_number" class="txt" value="<?php echo $data->id_card_number;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">生日</td>
				<td>
					<input type="text" name="birthday" class="date-txt txt" value="<?php echo $data->birthday;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">住址</td>
				<td>
					<textarea name="address" id="" cols="30" rows="10" class="txt small-txt"><?php echo $data->address;?></textarea>
				</td>
			</tr>
			<tr>
				<td class="col-label">电话</td>
				<td>
					<input type="text" name="tel" class="txt" value="<?php echo $data->tel;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">紧急电话</td>
				<td>
					<input type="text" name="urgent_tel" class="txt" value="<?php echo $data->urgent_tel;?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">入职时间</td>
				<td>
					<input type="text" name="entry_time" class="date-txt txt" value="<?php echo $data->entry_time ? date('Y-m-d',$data->entry_time) : '';?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">离职时间</td>
				<td>
					<input type="text" name="leave_time" class="date-txt txt" value="<?php echo $data->leave_time ? date('Y-m-d',$data->leave_time) : '';?>">
				</td>
			</tr>
			<tr>
				<td class="col-label">状态</td>
				<td>
					<?php foreach(User::$state_list as $s=>$n):?>
						<label>
							<input type="radio" name="state" value="<?php echo $s;?>" <?php echo $data->state == $s ? 'checked':'';?>>
							<?php echo $n;?>
						</label>
					<?php endforeach;?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="保存" class="btn" />
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>