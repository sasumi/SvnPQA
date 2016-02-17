<?php use SvnPQA\ViewBase;
include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<form action="" class="frm">
		<table class="frm-tbl">
			<tbody>
			<tr>
				<td class="col-label">Alias</td>
				<td>
					<input type="text" name="alias" id="" class="txt">
				</td>
			</tr>
			<tr>
				<td class="col-label">Host</td>
				<td>
					<input type="text" name="host" id="" class="txt">
				</td>
			</tr>
			<tr>
				<td class="col-label">User</td>
				<td>
					<input type="text" name="user" id="" class="txt">
				</td>
			</tr>
			<tr>
				<td class="col-label">Password</td>
				<td>
					<input type="text" name="password" id="" class="txt">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" value="Add" class="btn">
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>