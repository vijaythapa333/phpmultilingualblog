<!DOCTYPE html>
<html>
<head>
	<title><?php echo $lang['meta_title'] ?></title>

	<meta charset="utf-8">
	<meta title="description" content="<?php echo $lang['meta_description'] ?>">
	<meta title="keywords" content="<?php echo $lang['meta_keywords'] ?>">
	<meta title="Author" content="<?php echo $lang['author'] ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>assets/css/style.css">
</head>

<body>
	<header class="header">
		<div class="wrapper">
			<div class="logo">
				<h1><?php echo $lang['logo'] ?></h1>
			</div>

			<div class="menu">
				<ul>
					<li>
						<a href="<?php echo SITEURL; ?>"><?php echo $lang['home'] ?></a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>index.php?page=about"><?php echo $lang['about'] ?></a>
					</li>

					<?php 
						include('menu.php');
					?>
					
					<li class="right">
						<a href="<?php echo SITEURL; ?>index.php?lang=cn"><?php echo $lang['chinese'] ?></a>
					</li>
					<li class="right">
						<a href="<?php echo SITEURL; ?>index.php?lang=np"><?php echo $lang['nepali'] ?></a>
					</li>
					<li class="right">
						<a href="<?php echo SITEURL; ?>index.php?lang=en"><?php echo $lang['english'] ?></a>
					</li>
				</ul>

			</div>

			<div class="clearfix"></div>
		</div>
	</header>