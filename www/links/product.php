<?php
session_start();
$session = session_id();
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
<title>Цветы и букеты | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/product.css">
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
		<h1>
			<?php
				$result = mysql_query("SELECT * FROM category",$link);
				if (mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				do {
				echo '
					<a href="product.php?cat='.strtolower($row["id_category"]).'">'.$row["name_category"].'</a>
				';
				}
				while ($row = mysql_fetch_array($result));
				}
			?>
		</h1>
		<ul class="product">
			<?php
				$num = 8;
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
				
				if (empty($cat)){
					$result = mysql_query("SELECT * FROM product LIMIT $start, $num",$link);
					if (mysql_num_rows($result) > 0){
					$row = mysql_fetch_array($result);
						do {
							echo'
							<form method="post">
								<li>
								<input type="hidden" name="id_product" value="'.$row["id_product"].'"/>
								<img src="'.$row["image_product"].'"></img>
								<p class="name">'.$row["name_product"].'</p>
								<p class="block_product_price"><strong>Цена: '.$row["price_product"].'</strong> руб.</p>
								<p class="block_product_size">Размер цветка: '.$row["size_product"].' см.</p>
								<div class="block_product_description"><p>'.$row["description_product"].'</p>';
								if ($row["id_category"] == 1) {
									echo '<strong>Состав:</strong><br>'.$row["composition_product"].'</p></div>
									<input type="submit" name="add_to_cart" class="in_basket_b" value="Добавить в корзину"/>';
								}else{
							echo'
								<input type="submit" name="add_to_cart" class="in_basket" value="Добавить в корзину"/>
								</li>
							</form>
								';}
						}
					while($row = mysql_fetch_array($result));
					}
				}
				
				if (!empty($cat)){
					$result = mysql_query("SELECT * FROM product WHERE id_category='$cat' LIMIT $start, $num",$link);
					if (mysql_num_rows($result) > 0){
					$row = mysql_fetch_array($result);
						do {
							echo'
							<form method="post">
								<li>
								<input type="hidden" name="id_product" value="'.$row["id_product"].'"/>
								<img src="'.$row["image_product"].'"></img>
								<p class="name">'.$row["name_product"].'</p>
								<p class="block_product_price"><strong>Цена: '.$row["price_product"].'</strong> руб.</p>
								<p class="block_product_size">Размер цветка: '.$row["size_product"].' см.</p>
								<div class="block_product_description"><p>'.$row["description_product"].'</p>';
								if ($row["id_category"] == 1) {
									echo '<strong>Состав:</strong><br>'.$row["composition_product"].'</p></div>
									<input type="submit" name="add_to_cart" class="in_basket_b" value="Добавить в корзину"/>';
								}else{
							echo'
								<input type="submit" name="add_to_cart" class="in_basket" value="Добавить в корзину"/>
								</li>
							</form>
								';}
						}
					while($row = mysql_fetch_array($result));
					}
				}
			?>
		</ul>
		
		<ul class="product_nav">
		<?php
				if ($page != 1){ $pstr_prev = '<li><a href="product.php?page='.($page - 1).'">&lt;</a></li>';}
				if ($page != $total) $pstr_next = '<li><a href="product.php?page='.($page + 1).'">&gt;</a></li>';
			
				if($page - 1 > 0) $page_left = '<li><a href="product.php?page='.($page - 1).'">'.($page - 1).'</a></li>';
			
				if($page + 1 <= $total) $page_right = '<li><a href="product.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
			
				if ($total > 1){
					echo '<p>Страница: '.$page.'</p>';
					echo $pstr_prev.$page_left."<li><a href='product.php?page=".$page."'>".$page."</a></li>".$page_right.$strtotal.$pstr_next;
				}
		?>
		</ul>
		<?php
		if (isset($_POST['add_to_cart'])){
		
		$id_product = $_POST['id_product'];
		
		$id_product = strip_tags($id_product);
		$id_product = mysql_real_escape_string($id_product);
		$id_product = trim($id_product);
		
			$not = mysql_query("SELECT COUNT(session_basket) FROM basket WHERE session_basket = '".$session."'",$link);
			$not_test = mysql_fetch_array($not);
			
			$result_basket = mysql_query("SELECT id_basket FROM basket WHERE session_basket='".$session."'",$link);
			$result_bas = mysql_fetch_array($result_basket);
			
				if ($not_test[0] > 0) {
					mysql_query("INSERT INTO product_basket (id_product,id_basket) VALUES ('".$id_product."','".$result_bas['id_basket']."')",$link);
				} else {
					mysql_query("INSERT INTO basket (session_basket) VALUES ('".$session."')",$link);
					mysql_query("INSERT INTO product_basket (id_product,id_basket) VALUES ('".$id_product."','".$result_bas['id_basket']."')",$link);
				}
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
