<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SSWS PHP Test</title>
	<link rel="stylesheet" href="">
</head>
<body>

<?php echo "<h2>SSWS PHP Test</h2>
<br /> Domain: <strong>" . $_SERVER['SERVER_NAME'] . "</strong>
<br /> Test server: <strong>" . gethostname() . "</strong>
<br />
<br /> " . date("l jS \of F Y h:i:s A") . "<br>"; ?>

<h1>
	<?php $link_address = './';?>
	<a href="<?php echo $link_address; ?>"><button>&lt;&lt; <?php echo $_SERVER['SERVER_NAME'] ?></button></a>
</h1>

<!-- linkfy PHP -->
<!-- https://gist.github.com/jasny/2000705 -->

<br>


<?php
phpinfo();
?>

<script>
	console.info('Sea to Sky Web Solutions');
	console.info('https://github.com/giorgioriccardi');
	console.warn('<\?php phpinfo(); ?>');
</script>
</body>
</html>
