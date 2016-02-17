<?php
use function Lite\func\array_first;
use function Lite\func\dump;

$TITLE = 'CRUD配置...';
include 'inc.php';
$db_config_files = glob(PROJECT_PROTECTED_DIR.'/config/*db.inc.php');
$table_list = \Lite\Cli\get_all_table();
?>
<form action="">
	<fieldset>
		<legend>Scaffold CRUD Build</legend>
		<ul class="tab">
			<li class="active"><span>CRUD</span></li>
		</ul>

		<div class="step-list">
            <div class="step-col">
                <label>
                    选择数据库配置:
                </label>
                <div class="c">
                    <select name="" size="1">
                        <?php foreach($db_config_files as $k=>$f):?>
                            <option value="<?=$k;?>"><?=basename($f);?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
			<div class="step-col">
				<label>
					数据库表:
				</label>
				<div class="c">
					<select name="" size="10" multiple="multiple">
                        <?php foreach($table_list as $t):?>
						<option value=""><?=array_first($t);?></option>
                        <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="step-col">
				<label>TableModel:</label>
				<div class="c">
					<input type="text" name="">
				</div>
				<div class="c">
					<label>
						<input type="checkbox" name="">强制覆盖
					</label>
				</div>
				<input type="button" value="创建">
			</div>
			<div class="step-col">
				<label>Model:</label>
				<div class="c">
					<input type="text" name="">
				</div>
				<div class="c">
					<label>
						<input type="checkbox" name="">强制覆盖
					</label>
				</div>
				<input type="button" value="创建">
			</div>
			<div class="step-col">
				<label>Controller:</label>
				<div class="c">
					<input type="text" name="">
				</div>
				<div class="c">
					<label>
						<input type="checkbox" name="">强制覆盖
					</label>
				</div>
				<input type="button" value="创建">
			</div>
			<div class="step-col">
				<label>Template:</label>
				<div class="c">
					<input type="text" name="">
				</div>
				<div class="c">
					<label>
						<input type="checkbox" name="">强制覆盖
					</label>
				</div>
				<input type="button" value="创建">
			</div>
		</div>
	</fieldset>
	<div class="submit-row">
		<input type="button" value="上一步" onclick="location.href='step2.php';">
		<input type="submit" value="下一步">
	</div>
</form>
<style>
	.step-col {float:left; padding:1em 2em; margin:1em 0; width:220px; border-right:1px solid #eee; min-height:300px;}
	.step-col:last-child {border:none}
	.step-col label {margin-bottom:1em; display:block;}
    .step-col select {width:220px; min-width:0; font-size:14px;}
</style>
</body>
</html>