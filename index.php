<?php
include_once dirname(__FILE__) . '/common.php';
include_once dirname(__FILE__) . '/function.php';

if(isLogin()){
	$body = COMPONENT_DIR . 'create.php';
}

if(isset($_GET['links'])){
	links();
	exit;
}

$action = '';
if(isset($_GET['action'])){
	$action = $_GET['action'];
	$action();
}

include BASE_DIR . '/template/template.php';
