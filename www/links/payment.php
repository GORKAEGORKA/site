<?php
session_start();
session_regenerate_id();
$_SESSION = array();
session_destroy();
?>

<?php
$db_host			= 'localhost';
$db_user			= 'root';
$db_pass			= '';
$db_database		= 'flower';

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db($db_database,$link) or die("Нет соединения с БД".mysql_error());
mysql_query("Set names utf-8");

	$cat = $_GET["cat"];
	
	$cat = strip_tags($cat);
	$cat = mysql_real_escape_string($cat);
	$cat = trim($cat);
?>
<!DOCTYPE html>
<html>
<head>
<title>Оплата произведена успешно! | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<div class="header">
		<h1>Интернет-магазин "Цветы"</h1>
		<a href="../index.php" class="logo"><img src="../images/logo.svg" alt="logo"></img></a>
		<a href="cart.php?action=oneclick" class="basket">Корзина</a><br>
		<a href="../index.php" class="backG">Главная</a>
		<div class="menu">
			<a href="information.php"><div>
				<p>Информация</p>
			</div></a>
			<a href="sale.php"><div>
				<p>Акции</p>
			</div></a>
			<a href="product.php"><div>
				<p>Цветы и <br>букеты</p>
			</div></a>
			<a href="we.php"><div>
				<p>О нас</p>
			</div></a>
			<a href="delivery.php"><div>
				<p>Доставка и оплата</p>
			</div></a>
			<a href="contacts.php"><div>
				<p>Контакты</p>
			</div></a>
		</div>
	</div>
	<div class="main">
		<h1>Оплата произведена успешно!</h1>
	</div>
	<div class="footer">
	<p>Административная часть: <a href="auth.php">Войти</a></p>
		<a href="../index.php" class="logo"><img src="../images/logo.svg" alt="logo"></img></a>
		<div class="navigation">
			<p>Навигация:</p>
			<ul>
				<a href="../index.php"><li>Главная</li></a>
				<a href="cart.php?action=oneclick"><li>Корзина</li></a>
				<a href="information.php"><li>Информация</li></a>
				<a href="sale.php"><li>Акции</li></a>
				<a href="product.php"><li>Цветы и букеты</li></a>
				<a href="we.php"><li>О нас</li></a>
				<a href="delivery.php"><li>Доставка и оплата</li></a>
				<a href="contacts.php"><li>Контакты</li></a>
			</ul>
		</div>
		<div class="social">
			<p>Социльные сети:</p>
			<a href="#"><img src="../images/vk.png" alt="vk"></img></a>
			<a href="#"><img src="../images/instagram.png" alt="inst"></img></a>
			<a href="#"><img src="../images/twitter.png" alt="twit"></img></a>
			<p>Способы оплаты:</p>
			<a href="#"><img src="#" alt="#"></img></a>
			<a href="#"><img src="#" alt="#"></img></a>
			<a href="#"><img src="#" alt="#"></img></a>
		</div>
	</div>
</body>
</html>
