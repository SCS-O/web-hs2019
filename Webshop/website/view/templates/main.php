<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/stylesheet.css" />
</head>
<body>
	<nav>
		<a href="index.php">HOME</a> 
		<a href="index.php?action=contact">Contact</a>
  </nav>
	<?php include $innerTpl; ?>

</body>
</html>
