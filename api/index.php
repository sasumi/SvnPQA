<?php
include 'litephp/boot.inc.php';
use LITE\Application;
$d = dirname(__DIR__).DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR;
Application::init($d, Application::MODE_API);