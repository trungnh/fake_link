<?php

function login()
{
	if(isset($_SESSION['username'])){
		return true;
	}
	global $db, $body;
	if (isset($_POST['username']) and isset($_POST['password'])){
		$username   = $db->quote($_POST['username']);
		$password   = md5($_POST['password']);
		$query      = "SELECT * FROM `users` WHERE username=$username and password='{$password}' LIMIT 1";
		$rows       = $db->select($query);
		if(count($rows) == 1){
			$row = reset($rows);
			$_SESSION['username'] = $row['username'];
			$_SESSION['userid'] = $row['id'];
			$_SESSION['full_name'] = $row['full_name'];
			$body = COMPONENT_DIR . 'create.php';
		}else{
			$_SESSION['error'] = 'Login Fail!';
		}

		return true;
	}
}

function create()
{
	global $db, $body;
	$body = COMPONENT_DIR . 'create.php';

	if (isset($_POST['pc_link']) and isset($_POST['mobile_link'])){
		$pc_link        = $_POST['pc_link'];
		$mobile_link    = $_POST['mobile_link'];
		$username       = getCurrentUser();
		$userid         = getCurrentId();
		$url            = createLink($username);

		$query          = "INSERT INTO `links`(`url`, `pc_url`, `mobile_url`, `status`, `created_at`, `modified_at`) 
						VALUES ('{$url}','{$pc_link}','{$mobile_link}',1,'','')";
		$db->query($query);

		$lastInsertId   = $db->lastInsertId();
		$link_query     = "INSERT INTO `user_link`(`user_id`, `link_id`) 
						VALUES ('{$userid}',{$lastInsertId})";
		$db->query($link_query);
		$_SESSION['url'] = BASE_URL . 'links/' .$url;
	}
}

function createLink($user)
{
	$day = date('Ymd', time());
	$hash = md5(time());
	$url = "{$user}/{$day}/{$hash}";

	return $url;
}

function logout()
{
	global $body;

	unset($_SESSION['username']);
	$body = COMPONENT_DIR . 'login.php';
	return false;
}

function showlog()
{
	global $db, $body, $content;

	$currentUserId = getCurrentId();
	$query      = "SELECT l.url FROM links as l 
				INNER JOIN user_link as ul 
				ON ul.link_id = l.id
				WHERE ul.user_id = {$currentUserId}";

	$rows       = $db->select($query);
	if(count($rows)){
		foreach ($rows as $row){
			$content .= trim(BASE_URL . 'links/' . $row['url']) . PHP_EOL;
		}
	}

	$body = COMPONENT_DIR . 'showlog.php';
}

function links()
{
	global $db;
	if(isset($_GET['links'])){
		$link       = $_GET['links'];
		$query      = "SELECT `url`, `pc_url`, `mobile_url` FROM `links` WHERE `url` LIKE '{$link}'";
		$rows       = $db->select($query);
		if(count($rows)){
			$row = reset($rows);
			$pc_url = $row['pc_url'];
			$mobile_url = $row['mobile_url'];
			include BASE_DIR . '/rd_temp.php';
		}
	}
}

function isLogin()
{
	return isset($_SESSION['username']) ? true : false;
}

function getCurrentUser()
{
	return isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
}

function getCurrentUserName()
{
	return isset($_SESSION['full_name']) ? $_SESSION['full_name'] : getCurrentUser() ;
}

function getCurrentId()
{
	return $_SESSION['userid'];
}

