<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Trung đẹp trai</title>
	<link href="//getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_DIR; ?>/template/css/style.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo BASE_URL; ?>/index.php">Link Builder</a>
            </div>

            <div id="navbar">
	            <ul class="nav navbar-nav">
		            <?php if(isLogin()):?>
		            <li><a href="<?php echo BASE_URL; ?>/index.php?action=create">Create Ad</a></li>
		            <li><a href="<?php echo BASE_URL; ?>/index.php?action=edit">Edit Ad</a></li>
		            <li><a href="<?php echo BASE_URL; ?>/index.php?action=showlog">Log</a></li>
		            <?php endif; ?>
	            </ul>
	            <ul class="nav navbar-nav navbar-right">
		            <?php if(isLogin()):?>
		            <li><a>Chào <?php echo getCurrentUserName() ;?></a></li>
		            <li><a href="<?php echo BASE_URL; ?>/index.php?action=logout">Logout</a></li>
		            <?php endif; ?>
	            </ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>