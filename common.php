<?php
define('BASE_DIR', getcwd());
define('LINK_DIR', BASE_DIR . '/links/');
define('COMPONENT_DIR', BASE_DIR . '/template/component/');
define('REDIRECT_DIR', BASE_DIR . '/redirect/');
define('BASE_URL', 'http://link.local/');

include_once BASE_DIR . '/adapter.php';

session_start();
// Our database object
$db = new Db();

$header     = COMPONENT_DIR . 'header.php';
$body       = COMPONENT_DIR . 'login.php';
$footer     = COMPONENT_DIR . 'footer.php';

$content    = '';

