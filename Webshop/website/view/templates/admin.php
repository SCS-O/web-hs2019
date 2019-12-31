<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/stylesheet.css" />
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>  
</head>
<body>
	<nav>
		<a href="index.php">HOME</a> 
		<a href="index.php?action=admin_home">Admin</a>
		<a href="index.php?action=admin_userlist">User List</a>
 	</nav>
	<?php include $innerTpl; ?>
</body>
</html>
