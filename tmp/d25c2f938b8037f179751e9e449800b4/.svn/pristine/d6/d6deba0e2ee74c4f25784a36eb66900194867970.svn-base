<?php
$TITLE = '开始 - 站点信息...';
include 'inc.php';?>
<form action="step2.php">
	<fieldset>
		<legend>服务器环境</legend>
		<table class="frm-table">
			<tr>
				<td>软件环境</td>
				<td>
					<?php echo $_SERVER['SERVER_SOFTWARE'];?>
				</td>
			</tr>
			<tr>
				<td>PATH</td>
				<td>
					<?php echo $_SERVER['PATH'];?>
				</td>
			</tr>
			<tr>
				<td>PHP版本</td>
				<td>
					<?php echo phpversion();?>
					<?php item_check(version_compare('5.6', phpversion() >= 0));?>
				</td>
			</tr>
			<tr>
				<td>mbstring</td>
				<td><?php item_check(function_exists('mb_substr'));?></td>
			</tr>
			<tr>
				<td>GD2</td>
				<td>
					<?php item_check(function_exists('gd_info'));?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>框架环境</legend>
		<table class="frm-table">
			<tr>
				<td>LitePHP路径：</td>
				<td>
					<input type="text" name="lite_path" value="<?php echo $default['lite_path'];?>" required="required">
					<p class="desc">
						LitePHP框架路径，如：<var>../litephp/</var>。
						<span class="sup">
							建议：使用php.ini配置的include path目录，方便后续系统代码移植到其他平台
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td>FrontEnd URL：</td>
				<td>
					<input type="text" name="frontend_path" value="<?php echo $default['frontend_path'];?>">
					<p class="desc">
						FrontEnd前端框架url，如：<var>http：//www.site.com/frontend/</var>。如果站点没有使用到该框架，可不进行配置。
						<span class="sup">
							建议：使用与当前系统不一样的域名，可以提高站点安全、并发能力。
						</span>
					</p>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>基本信息</legend>
		<table class="frm-table">
			<tr>
				<td>命名空间：</td>
				<td>
					<input type="text" name="namespace" value="<?php echo $default['namespace'];?>" placeholder="如：www" required="required">
					<p class="desc">
						如存在多个应用在同一个硬件环境上，且可能互相调用，建议使用不同命名空间用于区分
					</p>
				</td>
			</tr>
			<tr>
				<td>站点名称：</td>
				<td>
					<input type="text" name="app_name" value="<?php echo $default['app_name'];?>" required="required">
					<p class="desc">
						一般只在模板里面用一下而已
					</p>
				</td>
			</tr>
			<tr>
				<td>站点URL：</td>
				<td>
					<input type="text" name="app_url" value="<?php echo $default['app_url'];?>" placeholder="如：http://www.abc.com/" required="required">
					<p class="desc">
						必须填写，否则程序将使用 $_SERVER['SCRIPT_FILE']为准（该类型配置可能会存在安全问题)
					</p>
				</td>
			</tr>
			<tr>
				<td>主题：</td>
				<td>
					<select name="">
						<option value="">缺省</option>
						<option value="">漂亮</option>
					</select>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>
			数据库
			<label>[<input type="checkbox" name="use_database" value="1" <?php echo $database['use_database'];?>>启用]</label>
		</legend>
		<p class="mod-desc">
			如果应用不需要配置数据库，请不要填写该项配置。
		</p>
		<table class="frm-table">
			<tr>
				<td>服务器：</td>
				<td>
					<input type="text" name="host" value="<?php echo $database['host'];?>" <?php echo $database['use_database'] ? '':'disabled="disabled"';?>>
				</td>
			</tr>
			<tr>
				<td>用户名：</td>
				<td><input type="text" name="user" value="<?php echo $database['user'];?>" <?php echo $database['use_database'] ? '':'disabled="disabled"';?>></td>
			</tr>
			<tr>
				<td>密码：</td>
				<td><input type="text" name="password" value="<?php echo $database['password'];?>" <?php echo $database['use_database'] ? '':'disabled="disabled"';?>></td>
			</tr>
			<tr>
				<td>数据库实例：</td>
				<td><input type="text" name="database" value="<?php echo $database['database'];?>" <?php echo $database['use_database'] ? '':'disabled="disabled"';?>></td>
			</tr>
			<tr>
				<td>表名前缀：</td>
				<td><input type="text" name="prefix" value="<?php echo $database['prefix'];?>" <?php echo $database['use_database'] ? '':'disabled="disabled"';?>></td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>站点配置参数</legend>
		<table class="frm-table">
			<tr>
				<td>自动收集SQL性能统计：</td>
				<td>
					<label>
						<input type="checkbox" name="auto_statistics" value="true" <?php echo $default['auto_statistics'] ? 'checked="checked"' : '';?>>开启
					</label>
					<p class="desc">
						正式环境不建议开启该项，建议在非正式环境开启。
						性能统计访问地址：http://www.abc.com?__=1
					</p>
				</td>
			</tr>
			<tr>
				<td>自动转化错误为标准输出：</td>
				<td>
					<label>
						<input type="checkbox" name="auto_process_logic_error" value="true" <?php echo $default['auto_process_logic_error'] ? 'checked="checked"' : '';?>>开启
					</label>
				</td>
			</tr>
			<tr>
				<td>调试模式：</td>
				<td>
					<label>
						<input type="checkbox" name="debug" value="1" <?php echo $default['auto_statistics'] ? 'checked="checked"' : '';?>>开启
					</label>
					<p class="desc">
						正式环境需要关闭该项选项。
					</p>
				</td>
			</tr>
		</table>
	</fieldset>
	<div class="submit-row">
		<input type="submit" value="下一步">
	</div>
</form>
</body>
</html>