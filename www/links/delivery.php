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
<title>Доставка и оплата | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/delivery.css">
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
		<h1>Доставка и оплата</h1>
		<img src="../images/delivery_image_1.jpg"></img>
		<p>Уважаемые клиенты мы ценим ваше время и конечно у нас работает доставка цветов по Москве и ближнему Подмосковью.<br>
		Базовые цены на доставку:<br>
		2. Москва (внутри МКАД) - 400 руб.<br>
		3. Подмосковье 600 руб.<br>
		Наши курьеры доставят ваш букет максимально бережно! 
		Мы используем специальную фирменную упаковку для перевозки, 
		которая сохраняет цветы и аксессуары от повреждений, лома и увядания!
		</p>
		<img src="../images/delivery_image_2.jpg"></img>
		<p>Оплата. 
		Производится произвольной банковской картой - любой банковской картой действующей на территории РФ или наличными.</p>
		<h2>Ситуации:</h2>
		<ul>
			<li><strong>
				Курьер приехал с букетом, а получателя нет на месте. Если адрес или контакты 
				получателя были указаны неверно или не полностью.</strong>
			</li> 
			<li>
				Позвоним Вам, чтобы попытаться решить сложившуюся ситуацию. Курьер будет 
				ждать 10 минут. Если получатель так и не пришел, мы свяжемся с вами. 
				Повторный выезд курьера - платный, на тех же условиях, что и первая доставка. 
				Если вы решите перенести доставку на другой день, когда цветы 
				перестанут быть свежими, то вам необходимо будет оплатить новый букет.
			</li>
			<li><strong>
				Если адрес или номер получателя были указаны неверно/не полностью, выполнение 
				вашего заказа может значительно задержаться.</strong>
			</li>
			<li>
				Чтобы избежать подобной ситуации, пожалуйста, убедитесь в том, что все данные 
				получателя соответствуют действительности.
			</li> 
			<li><strong>
				Если букет не удалось доставить из-за препятствия (закрытая входная дверь,
				контрольно-пропускная система).</strong>
			</li> 
			<li>
				Если курьер не был предупреждён заранее о возможных препятствиях, существует
				вероятность повторной доставки. Чтобы избежать подобной 
				ситуации, оформляя заказ, пожалуйста, укажите особенности доступа к получателю:
				код домофона, возможность пройти через контрольно-пропускную систему и т.п.)
			</li>
		</ul>
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