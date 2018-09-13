<?php
session_start();
$session = session_id();
if (isset($_POST["submitdata"])){
	$_SESSION["order_delivery"] = $_POST["order_delivery"];
	$_SESSION["order_payment"] = $_POST["order_payment"];
	$_SESSION["order_fio"] = $_POST["order_fio"];
	$_SESSION["order_address"] = $_POST["order_address"];
	$_SESSION["order_number"] = $_POST["order_number"];
	$_SESSION["order_email"] = $_POST["order_email"];
	$_SESSION["order_comment"] = $_POST["order_comment"];

	header("location: cart.php?action=completion");
}
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
<?php
	$id_p = $_GET["id_p"];
	$id_p = strip_tags($id_p);
	$id_p = mysql_real_escape_string($id_p);
	$id_p = trim($id_p);
	
	$id_b = $_GET["id_b"];
	$id_b = strip_tags($id_b);
	$id_b = mysql_real_escape_string($id_b);
	$id_b = trim($id_b);
	
	$action = $_GET["action"];
	$action = strip_tags($action);
	$action = mysql_real_escape_string($action);
	$action = trim($action);
	
	switch ($action) {
		case 'clear':
		$clear = mysql_query("DELETE id_product_basket FROM product_basket WHERE id_basket = '$id_b'",$link);
		break;
		
		case 'delete':
		$delete = mysql_query("DELETE FROM product_basket WHERE id_product = '$id_p' AND id_basket = '$id_b'",$link);
		break;
	}
$result_all = mysql_query("SELECT * FROM basket, product, product_basket WHERE product_basket.id_basket = basket.id_basket AND basket.session_basket = '$session' AND product.id_product = product_basket.id_product",$link);
		if (mysql_num_rows($result_all) > 0)
		{
		$row_all = mysql_fetch_array($result_all);
		do
		{
			$int_all = $row_all["price_product"] * $row_all["quantity_product_basket"];
			$amount_all = $amount_all + $int_all;
			
			
		}
		while ($row_all = mysql_fetch_array($result_all));
		};
?>
<!DOCTYPE html>
<html>
<head>
<title>Корзина товаров | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cart.css">
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
			<a href="sale/php"><div>
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
		<h1>Корзина</h1>
		<?php
		$num = 3;
				$page = (int)$_GET['page'];
				
				$count = mysql_query("SELECT COUNT(*) FROM product",$link);
				$temp = mysql_fetch_array($count);
				
				if ($temp[0] > 0){
					$tempcount = $temp[0];
					$total = (($tempcount - 1) / $num) + 1;
					$total = intval($total);
					
					$page = intval($page);
					
					if(empty($page) or $page < 0) $page = 1;
					if($page > $total) $page = $total;
					
					$start = $page * $num - $num;
				}
		switch ($action) {
			case 'oneclick':
		echo'
		<div class="block_step">
			<div class="name_step">
				<ul>
				<li><a href="cart.php?action=oneclick" class="active">1. Корзина товаров</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=confirm">2. Контактная информация</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=completion">3. Завершение</a></li>
				</ul>
			</div>
			
			<p>Шаг 1 из 3</p>
			<a href="cart.php?action=clear">Очистить</a>
		</div>
		';
		$result = mysql_query("SELECT * FROM basket, product, product_basket WHERE product_basket.id_basket = basket.id_basket AND basket.session_basket = '$session' AND product.id_product = product_basket.id_product LIMIT $start, $num",$link);
		if (mysql_num_rows($result) > 0)
		{
		$row = mysql_fetch_array($result);
		
		echo '
		<div class="title_list_cart">
			<div class="title_img">
				<p>Изображение</p>
			</div>
			<div class="title_description">
				<p>Наименование товара</p>
			</div>
			<div class="title_quantity">
				<p>Кол-во</p>
			</div>
			<div class="title_price">
				<p>Цена</p>
			</div>
		</div>
		';
		do
		{
			$int = $row["price_product"] * $row["quantity_product_basket"];
			$amount = $amount + $int;
			
			echo '
		<div class="block_list_cart">
			<div class="block_img">
				<p align="center"><img src="'.$row["image_product"].'"></img</p>
			</div>
			<div class="block_description">
				<p class="list_name">'.$row["name_product"].'</p>
				<p class="list_description">'.$row["description_product"].'</p>
			</div>
			<div class="block_quantity">
				<ul>
						<p>-</p>
					</li>
					<li>
						<p align="center"><input maxlength="3" type="text" value="'.$row["quantity_product_basket"].'"></input></p>
					</li>
					<li>
						<p>+</p>
					</li>
				</ul>
			</div>
			<div class="block_price">
				<p><span>'.$row["quantity_product_basket"].'</span> x <span>'.$row["price_product"].' руб.</span></p>
				<p><strong>'.$int.' руб.</strong></p>
			</div>
			<div class="block_delete">
				<a href="cart.php?id_p='.$row['id_product'].'&id_b='.$row['id_basket'].'&action=delete">Удалить</a>
			</div>
		</div>
		
		';
		}
		while ($row = mysql_fetch_array($result));
		echo '
		<h2 class="amount_money" align="right">Итог: '.$amount_all.' руб.</h2>
		<p class="button_next" align="right"><a href="cart.php?action=confirm">Далее</a></p>
		';?>
		<ul class="product_nav">
		<?php
				if ($page != 1){ $pstr_prev = '<li><a href="cart.php?action=oneclick&page='.($page - 1).'">&lt;</a></li>';}
				if ($page != $total) $pstr_next = '<li><a href="cart.php?action=oneclick&page='.($page + 1).'">&gt;</a></li>';
			
				if($page - 1 > 0) $page_left = '<li><a href="cart.php?action=oneclick&page='.($page - 1).'">'.($page - 1).'</a></li>';
			
				if($page + 1 <= $total) $page_right = '<li><a href="cart.php?action=oneclick&page='.($page + 1).'">'.($page + 1).'</a></li>';
			
				if ($total > 1){
					echo '<p>Страница: '.$page.'</p>';
					echo $pstr_prev.$page_left."<li><a href='cart.php?action=oneclick&page=".$page."'>".$page."</a></li>".$page_right.$strtotal.$pstr_next;
				}
		?>
		</ul>
		<?php
		} else {
			echo '<h1 class="clear_cart">Корзина пуста</h1>';
		}
			break;	
			
			case 'confirm':
		echo'
		<div class="block_step">
			<div class="name_step">
				<ul>
				<li><a href="cart.php?action=oneclick" >1. Корзина товаров</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=confirm" class="active">2. Контактная информация</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=completion">3. Завершение</a></li>
				</ul>
			</div>
			
			<p>Шаг 2 из 3</p>
			
		</div>
		';	
		
		if ($_SESSION['order_delivery'] == "Курьер") $chkd1 = "checked";
		if ($_SESSION['order_delivery'] == "Самовывоз") $chkd2 = "checked";
		if ($_SESSION['order_payment'] == "Наличные") $chkd3 = "checked";
		if ($_SESSION['order_payment'] == "Безналичные") $chkd4 = "checked";
		
		echo '
		<form method="post">
		<h3 class="info_radio">Способ доставки:</h3>
			<ul class="info_radio">
				<li>
					<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Курьер" '.$chkd1.'/>
					<label class="label_delivery" for="order_delivery1">Курьер</label>
				</li>
				<li>
					<input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Самовывоз" '.$chkd2.'/>
					<label class="label_delivery" for="order_delivery2">Самовывоз</label>
				</li>
			</ul>
			<h3 class="info_order">Информация для доставки:</h3>
			<ul class="info_order">
				<li>
					<label for="order_fio"><span>*</span>ФИО</label>
					<input type="text" name="order_fio" value="'.$_SESSION["order_fio"].'"/>
					<span>Пример: Иванов Иван Иванович</span>
				</li>
				<li>
					<label for="order_payment"><span>*</span>Способ оплаты</label>
					<input type="radio" name="order_payment" class="order_payment" id="order_payment1" value="Наличные" '.$chkd3.'/><label for="order_payment">Наличные</label>
					<input type="radio" name="order_payment" class="order_payment" id="order_payment2" value="Безналичные" '.$chkd4.'/><label for="order_payment">Безналичные</label>
				</li>
				<li>
					<label for="order_address"><span>*</span>Адрес доставки</label>
					<input type="text" name="order_address" value="'.$_SESSION["order_address"].'"/>
					<span>Пример: г. Москва, Красная площадь д. 1, кв. 1</span>
				</li>
				<li>
					<label for="order_number"><span>*</span>Номер телефона</label>
					<input type="number" name="order_number" value="'.п.'"/>
					<span>Пример: 89998085153</span>
				</li>
				<li>
					<label for="order_email"><span>*</span>E-mail</label>
					<input type="email" name="order_email" value="'.$_SESSION["order_email"].'"/>
					<span>Пример: flower@flower.ru</span>
				</li>
				<li>
					<label for="order_comment"><span>*</span>Комментарий</label>
					<textarea name="order_comment">'.$_SESSION["order_comment"].'</textarea>
				</li>
				<ul>
					<p align="right"><input type="submit" name="submitdata" id="confirm_button_next" value="Далее"/></p>
		</form>
		'; 
		$sees_order = mysql_query("SELECT id_basket FROM basket WHERE session_basket = '$session'",$link);
		$ses_order = mysql_fetch_array($sees_order);
		
		$basket_order = $ses_order['id_basket'];
		
		if (isset($_POST['submitdata']) && trim($_POST['submitdata'])){
			$orderss_delivery = $_SESSION["order_delivery"];
			
			$orderss_payment = $_SESSION["order_payment"];
			$orderss_fio = $_SESSION["order_fio"];
			$orderss_address = $_SESSION["order_address"];
			$orderss_number = $_SESSION["order_number"];
			$orderss_email = $_SESSION["order_email"];
			$orderss_comment = $_SESSION["order_comment"];

			$query="INSERT INTO `order`(`id_basket`, `amount_order`, `fio_order`, `payment_order`, `address_order`, `number_order`, 
			`email_order`, `comment_order`, `delivery_order`) 
			VALUES ('".$basket_order."','".$amount_all."','".$orderss_fio."','".$orderss_payment."','".$orderss_address."','".$orderss_number."','".$orderss_email."'
			,'".$orderss_comment."','".$orderss_delivery."')";
			$ok=mysql_query($query,$link);
			
		}
			break;
			
			case 'completion':
		echo'
		<div class="block_step">
			<div class="name_step">
				<ul>
				<li><a href="cart.php?action=oneclick" >1. Корзина товаров</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=confirm" >2. Контактная информация</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=completion"  class="active">3. Завершение</a></li>
				</ul>
			</div>
			
			<p>Шаг 3 из 3</p>
			
		</div>
			<h3 class="completion_title">Конечная информация:</h3>
			<ul class="completion">
				<li><strong>Способ доставки: </strong>'.$_SESSION['order_delivery'].'</li>
				<li><strong>Способ оплаты: </strong>'.$_SESSION['order_payment'].'</li>
				<li><strong>ФИО: </strong>'.$_SESSION['order_fio'].'</li>
				<li><strong>Адрес доставки: </strong>'.$_SESSION['order_address'].'</li>
				<li><strong>Номер телефона: </strong>'.$_SESSION['order_number'].'</li>
				<li><strong>E-mail: </strong>'.$_SESSION['order_email'].'</li>
				<li><strong>Комментарий: </strong>'.$_SESSION['order_comment'].'</li>
				<li><strong>Итоговая цена: </strong>'.$amount_all.'  руб.</li>
			</ul>
			<p align="center"><a href="payment.php" class="final_cart">Оплатить</a></p>
		';	
		mysql_query("UPDATE basket SET session_basket = 'КОНЕЦ' WHERE session_basket = '$session'",$link);
			break;
			
			default:
			echo'
		<div class="block_step">
			<div class="name_step">
				<ul>
				<li><a href="cart.php?action=oneclick" class="active">1. Корзина товаров</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=confirm">2. Контактная информация</a></li>
				<li><span>&rarr;</span></li>
				<li><a href="cart.php?action=completion">3. Завершение</a></li>
				</ul>
			</div>
			
			<p>Шаг 1 из 3</p>
			<a href="cart.php?action=clear">Очистить</a>
		</div>
		';
		$result = mysql_query("SELECT * FROM basket, product, product_basket WHERE product_basket.id_basket = basket.id_basket AND basket.session_basket = '$session' AND product.id_product = product_basket.id_product LIMIT $start, $num",$link);
		if (mysql_num_rows($result) > 0)
		{
		$row = mysql_fetch_array($result);
		
		echo '
		<div class="title_list_cart">
			<div class="title_img">
				<p>Изображение</p>
			</div>
			<div class="title_description">
				<p>Наименование товара</p>
			</div>
			<div class="title_quantity">
				<p>Кол-во</p>
			</div>
			<div class="title_price">
				<p>Цена</p>
			</div>
		</div>
		';
		
		do
		{
			$int = $row["price_product"] * $row["quantity_product_basket"];
			$amount = $amount + $int;
			
			echo '
		<div class="block_list_cart">
			<div class="block_img">
				<p align="center"><img src="'.$row["image_product"].'"></img</p>
			</div>
			<div class="block_description">
				<p class="list_name">'.$row["name_product"].'</p>
				<p class="list_description">'.$row["description_product"].'</p>
			</div>
			<div class="block_quantity">
				<ul>
						<p>-</p>
					</li>
					<li>
						<p align="center"><input maxlength="3" type="text" value="'.$row["quantity_product_basket"].'"></input></p>
					</li>
					<li>
						<p>+</p>
					</li>
				</ul>
			</div>
			<div class="block_price">
				<p><span>'.$row["quantity_product_basket"].'</span> x <span>'.$row["price_product"].' руб.</span></p>
				<p><strong>'.$int.' руб.</strong></p>
			</div>
			<div class="block_delete">
				<a href="cart.php?id_p='.$row['id_product'].'&id_b='.$row['id_basket'].'&action=delete">Удалить</a>
			</div>
		</div>
		
		';
		}
		while ($row = mysql_fetch_array($result));
		echo '
		<h2 class="amount_money" align="right">Итог: '.$amount_all.' руб.</h2>
		<p class="button_next" align="right"><a href="cart.php?action=confirm">Далее</a></p>
		';?>
		<ul class="product_nav">
		<?php
				if ($page != 1){ $pstr_prev = '<li><a href="cart.php?action=oneclick&page='.($page - 1).'">&lt;</a></li>';}
				if ($page != $total) $pstr_next = '<li><a href="cart.php?action=oneclick&page='.($page + 1).'">&gt;</a></li>';
			
				if($page - 1 > 0) $page_left = '<li><a href="cart.php?action=oneclick&page='.($page - 1).'">'.($page - 1).'</a></li>';
			
				if($page + 1 <= $total) $page_right = '<li><a href="cart.php?action=oneclick&page='.($page + 1).'">'.($page + 1).'</a></li>';
			
				if ($total > 1){
					echo '<p>Страница: '.$page.'</p>';
					echo $pstr_prev.$page_left."<li><a href='cart.php?action=oneclick&page=".$page."'>".$page."</a></li>".$page_right.$strtotal.$pstr_next;
				}
		?>
		</ul>
		<?php
		} else {
			echo '<h1 class="clear_cart">Корзина пуста</h1>';
		}
			break;
		}
		?>
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
