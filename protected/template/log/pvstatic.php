<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('log/pvStatic');?>" class="search-frm well">
		<div class="frm-item">
			<label>
				栏目：
				<select name="catalog">
					<?php foreach($all_catalog as $catalog):?>
						<option value="<?php echo $catalog;?>" <?php echo $catalog==$search['catalog'] ? 'selected' :'';?>><?php echo $catalog;?></option>
					<?php endforeach;?>
				</select>
			</label>
		</div>
		<div class="frm-item">
			<label>
				子栏目：
				<input type="text" class="txt" name="kw" value="<?php echo $search['kw'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				时间：
				<input type="text" name="start_time" value="<?php echo $search['start_time']?>" class="txt date-txt" /> 至
				<input type="text" name="end_time" value="<?php echo $search['end_time']?>" class="txt date-txt" />
			</label>
		</div><br/>
		<div class="frm-item">
			<input type="submit" value="检索" class="btn btn-default" />
			<a href="<?php echo $this->getUrl('log/pvStatic');?>">重置搜索</a>
		</div>
	</form>

	<script type="text/javascript">
		seajs.use('jquery', function(){
			seajs.use('hightchart/js/highcharts', function(){
				$(function () {
					$('#chart_div').highcharts({
						chart: {
							type: 'spline'
						},
						title: {
							text: 'PV/UV统计（每小时）',
							x: -20 //center
						},
						xAxis: {
							categories: <?php echo json_encode($categories);?>
						},
						yAxis: {
							title: {
								text: '数量'
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'middle',
							borderWidth: 0
						},
						series: <?php echo json_encode($seris);?>
					});
				});
			});
		});
	</script>
	<div id="chart_div" style="width:100%; height:300px; margin-bottom:20px"></div>

	<script type="text/javascript">
		seajs.use('jquery', function(){
			seajs.use('hightchart/js/highcharts', function(){
				$('#chart_div_day').highcharts({
					chart: {
						type: 'spline'
					},
					title: {
						text: 'PV/UV统计（每日）',
						x: -20 //center
					},
					xAxis: {
						categories: <?php echo json_encode($categories_day);?>,
					},
					yAxis: {
						title: {
							text: '数量'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: <?php echo json_encode($seris_day);?>
				});
			});
		});
	</script>
	<div id="chart_div_day" style="width:100%; height:300px; margin-bottom:20px"></div>
</div>
<?php include $this->getTemplate('inc/footer.inc.php'); ?>