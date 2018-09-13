<?php
session_start();
?>
<?php
$db_host			= 'localhost';
$db_user			= 'root';
$db_pass			= '';
$db_database		= 'flower';

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db($db_database,$link) or die("Нет соединения с БД".mysql_error());
mysql_query("Set names utf-8");
?>
<!DOCTYPE html>
<html>
<head>
<title>Главная | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<div class="header">
		<h1>Интернет-магазин "Цветы"</h1>
		<a href="index.php" class="logo"><img src="images/logo.svg" alt="logo"></img></a>
		<a href="links/cart.php?action=oneclick" class="basket">Корзина</a><br>
		<a href="index.php" class="backG">Главная</a>
		<div class="menu">
			<a href="links/information.php"><div>
				<p>Информация</p>
			</div></a>
			<a href="links/sale.php"><div>
				<p>Акции</p>
			</div></a>
			<a href="links/product.php"><div>
				<p>Цветы и <br>букеты</p>
			</div></a>
			<a href="links/we.php"><div>
				<p>О нас</p>
			</div></a>
			<a href="links/delivery.php"><div>
				<p>Доставка и оплата</p>
			</div></a>
			<a href="links/contacts.php"><div>
				<p>Контакты</p>
			</div></a>
		</div>
	</div>
	<div class="main">
		<h1>Главная</h1>
		<img src="images/index_image_1.jpg"></img>
		<p>Интернет-магазин цветов работает 11 часов, в любое время года мы готовы 
		обеспечить наших клиентов свежими цветами, оригинальными цветочными композициями и просто хорошим 
		настроением. Чтобы купить цветы в магазине без суеты и хлопот, не нужно тратить время на поиск 
		и посещение цветочного магазина, ведь купить цветы можно не выходя из дома, офиса, из любого места, 
		где есть Интернет. Даже если Интернет отсутствует, запишите наш номер телефона, мы и в этом случае 
		поможем с покупкой цветов. Качественные букеты – 
		наша задача при обращении клиентов в магазин «Цветы».</p>
		<h2>Контакты:</h2>
		<div>
			<img src="images/index_image_2.jpg"></img>
			<p>От цветочных композиций до оформления офиса горшечными растениями — дизайнеры салона 
			умеют делать абсолютно всё. Так что если хотите подарить близким эстетическое удовольствие, 
			вам сюда.</p>
			<p>Адрес: Кленовый бульвар д.26<br> Телефон: 8(495)655-52-30</p>
		</div>
	</div>
	<div class="footer">
		<p>Административная часть: <a href="links/auth.php">Войти</a></p>
		<a href="index.php" class="logo"><img src="images/logo.svg" alt="logo"></img></a>
		<div class="navigation">
			<p>Навигация:</p>
			<ul>
				<a href="index.php"><li>Главная</li></a>
				<a href="links/cart.php?action=oneclick"><li>Корзина</li></a>
				<a href="links/information.php"><li>Информация</li></a>
				<a href="links/sale.php"><li>Акции</li></a>
				<a href="links/product.php"><li>Цветы и букеты</li></a>
				<a href="links/we.php"><li>О нас</li></a>
				<a href="links/delivery.php"><li>Доставка и оплата</li></a>
				<a href="links/contacts.php"><li>Контакты</li></a>
			</ul>
		</div>
		<div class="social">
			<p>Социльные сети:</p>
			<a href="#"><img src="images/vk.png" alt="vk"></img></a>
			<a href="#"><img src="images/instagram.png" alt="inst"></img></a>
			<a href="#"><img src="images/twitter.png" alt="twit"></img></a>
			<p>Способы оплаты:</p>
			<a href="#"><img src="#" alt="#"></img></a>
			<a href="#"><img src="#" alt="#"></img></a>
			<a href="#"><img src="#" alt="#"></img></a>
		</div>
	</div>
</body>
</html>