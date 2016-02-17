<?php
use Lite\Cli\CodeGenerator;

include '../../litephp/bootstrap.php';

define('PROJECT_ROOT', dirname(__DIR__));
CodeGenerator::Load();

define('STEP', intval($_GET['step']) ?: 1);
function item_check($result){
	echo '<span class="'.($result ? 'fa fa-check' : 'fa fa-remove').'"></span>';
}
$default = array(
	'lite_path' => '../litephp/',
	'frontend_path' => '/frontend/',
	'namespace' => 'www',
	'app_name' => '默认',
	'app_url' => 'http://localhost/www/',
	'auto_statistics' => true,
	'debug' => true,
	'auto_process_logic_error' => true
);

$database = array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => '123456',
	'database' => '',
	'use_database' => true,
);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body {background:url('data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjAtYzA2MCA2MS4xMzQ3NzcsIDIwMTAvMDIvMTItMTc6MzI6MDAgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzUgTWFjaW50b3NoIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjA4NUEzNDVCQzE3NTExRTJCNEIxQTA3MDRCMUJCNkNFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjA4NUEzNDVDQzE3NTExRTJCNEIxQTA3MDRCMUJCNkNFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MDg1QTM0NTlDMTc1MTFFMkI0QjFBMDcwNEIxQkI2Q0UiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MDg1QTM0NUFDMTc1MTFFMkI0QjFBMDcwNEIxQkI2Q0UiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAABAQEBAQEBAQEBAQEBAQEBAQEB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')}
		body,input {font-size:1em; font-family:Helvetica, Microsoft Yahei, SimSun, Courier new, Tahoma, Lucida Grande, serif; text-shadow:1px 1px 1px white; padding:0 1em;}
		body {margin:0; padding:0 0 50px 0;}
		h1 {margin:1em}
		p {padding:0.3em 0; margin:0}
		fieldset {margin:1em; background-color:#fff; border:1px groove threedface; border-color:#fff;}
		label {cursor:pointer;}
		input { vertical-align:middle;}
		input[type=text]{padding:5px 5px; border:none; border-bottom:1px solid #ccc; min-width:200px;}
		input[type=submit],
		input[type=button]{padding:5px 20px; cursor:pointer;}
		input[type=text][disabled=disabled]{color:#ccc; background:#eee; border-color:transparent}
		body *[required=required]{border-color:#ff5500}
		select {padding:5px 5px; border-radius:3px; border:1px solid #ccc; min-width:200px;}
		.tab {border-bottom:1px solid #ccc; padding:0 20px; height:27px;}
		.tab li {float:left; list-style:none; margin-right:10px; padding:4px 15px; cursor:pointer; border-radius:2px 2px 0 0; background-color:#eee; border:1px solid #ccc; margin-bottom:-1px;}
		.tab .active {background-color:white; border-bottom:1px solid white; cursor:default}

		.frm-table {margin:10px 0; width:100%}
		.frm-table tr td:first-child {width:150px; white-space:nowrap; text-align:right; padding:5px 1em 5px 0;}
		.frm-table tr td:last-child {word-break:break-all}
		.frm-table tr td{vertical-align:top; padding-top:5px; padding-bottom:5px; border-bottom:1px dashed #eee;}
		.frm-table tr:last-child td {border:none;}
		.desc {color:gray; line-height:1.8; font-size:0.8em; max-width:40%;}
		.mod-desc {float:right; margin:0 10px 0 0; color:gray;}
		.sup {display:block; background-color:#eee; padding:1px 10px; border-radius:3px;}
		.submit-row { position:fixed; bottom:0; padding:10px; background-color:rgba(108, 108, 108, 0.67); width:100%; text-align:center}

		.optional-frm-table {margin:20px 0;}
		.optional-frm-table td {vertical-align:top; padding:0 30px; border-right:1px solid #eee;}
		.optional-frm-table td .c {margin:10px 0}
		.optional-frm-table input[type=text] {border:1px solid #ccc;}
		.optional-frm-table select {margin-bottom:10px;}
		var {color:darkgreen}
		legend {background-color:white; padding:3px 10px; border:1px solid #ccc;}
		legend label {font-size:12px; vertical-align:middle; margin-left:10px;}
		.fa-check {color:green;}
		.fa-close {color:red;}
	</style>
	<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
</head>
<body>
<h1><?php echo $TITLE;?></h1>