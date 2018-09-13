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
<title>О нас | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/we.css">
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
		<h1>О нас</h1>
		<img src="../images/we_image_1.jpg"></img>
		<p>Всегда так сложно подобрать слова, говоря о самом себе, но так легко рассказывать о любимом деле.
		То, чем занимаемся каждый день, не просто работа - это наше вдохновение, наш стимул к собственному росту.
		В стремлении создать особенный, удобный, качественный и
		по- настоящему полезный продукт, мы тесно работаем с нашими клиентами, прислушиваемся к их мнению, стараемся для них. 
		Следим за тенденциями и современными технологиями, в каждое событие вкладываем частичку себя. Наша цель - сделать 
		каждого кто решил идти с нами счастливым, сделать событие незабываемым!
		Наш магазин "Цветы» задумывался очень давно. Нам хотелось заполнить пустоту между дорогими цветочными салонами и 
		киосками у метро с букетами в целлофане живой и не пафосной городской флористикой. Чтобы люди приходя к нам, могли 
		почувствовать себя уютно. Могли собрать удивительные букеты для любых событий, находили приятные подарки близким, 
		и могли выпить чашечку вкуснейшего кофе.</p>
		<h2>Контакты:</h2>
		<div>
			<img src="../images/index_image_2.jpg"></img>
			<p>От цветочных композиций до оформления офиса горшечными растениями — дизайнеры салона 
			умеют делать абсолютно всё. Так что если хотите подарить близким эстетическое удовольствие, 
			вам сюда.</p>
			<p>Адрес: Кленовый бульвар д.26<br> Телефон: 8(495)655-52-30</p>
		</div>
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
