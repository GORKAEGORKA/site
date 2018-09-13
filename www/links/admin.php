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

$section = $_GET["section"];
	
$section = strip_tags($section);
$section = mysql_real_escape_string($section);
$section = trim($section);

$active = $_GET["active"];
	
$active = strip_tags($active);
$active = mysql_real_escape_string($active);
$active = trim($active);
?>
<!DOCTYPE html>
<html>
<head>
<title>Административная панель | Интернет-магазин "Цветы"</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<h1  align="center">
	<a href="admin.php?section=product"> Товар </a>/
	<a href="admin.php?section=category"> Категории</a>/
	<a href="admin.php?section=order"> Заказы </a>/
	<a href="admin.php?section=auth"> Смена пароля</a>
	</h1><br>
	<h2 align="center">
	Выбран раздел: 
	<?php
		if ($section == 'product') {
			echo 'Товар';
		}elseif ($section == 'category') {
			echo 'Категории';
		}elseif ($section == 'order') {
			echo 'Заказы';
		}elseif ($section == 'auth') {
			echo 'Смена пароля';
		}
	?>
	</h2>
	<div class="section">
	<?php
		if ($section == 'product') {
			
			echo'
				<table>
					<tr>
						<td>ID Товара</td>
						<td>ID Категории</td>
						<td>Наименование</td>
						<td>Описание</td>
						<td>Изображение</td>
						<td>Цена</td>
						<td>Количество на складе</td>
						<td>Состав букета</td>
						<td>Размер(в см.)</td>
					</tr>
			';
				$result = mysql_query("SELECT * FROM product",$link);
				if (mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				do {
				echo '
					<tr>
						<td>'.$row['id_product'].'</td>
						<td>'.$row['id_category'].'</td>
						<td>'.$row['name_product'].'</td>
						<td>'.$row['description_product'].'</td>
						<td><img src="'.$row['image_product'].'"></td>
						<td>'.$row['price_product'].'</td>
						<td>'.$row['quanity_product'].'</td>
						<td>'.$row['composition_product'].'</td>
						<td>'.$row['size_product'].'</td>
					</tr>
				';
				}
				while ($row = mysql_fetch_array($result));
				}
				echo '
				</table>
				';
				echo '<div class="active_product">
						<h2  align="center">
						<a href="admin.php?section=product&active=add_product"> Добавить </a>/
						<a href="admin.php?section=product&active=change_product"> Изменить </a>/
						<a href="admin.php?section=product&active=delete_product"> Удалить </a>/
						</h2><br>
				';
				if ($active == 'add_product') {
					echo '
						<h2>Добавление</h2>
						<form method="post">
						<label for="category_add_product">*Введите номер категории</label><input name="category_add_product" type="number"/><br>
						<label for="name_add_product">*Введите наименование товара</label><input name="name_add_product" type="text"/><br>
						<label for="description_add_product">*Введите описание товара</label><textarea name="description_add_product"></textarea><br>
						<label for="image_add_product">*Введите имя картинки(с расширением)</label><input name="image_add_product" type="text"/><br>
						<label for="price_add_product">*Введите цену товара</label><input name="price_add_product" type="number"/><br>
						<label for="quantity_add_product">*Введите количество товаров на складе</label><input name="quantity_add_product" type="number"/><br>
						<label for="composition_add_product">*Введите состав букета(если букет)</label><textarea name="composition_add_product" type="text"></textarea><br>
						<label for="size_add_product">*Введите размер товара(в см.)</label><input name="size_add_product" type="number"/><br>
						<input type="submit" name="add_to_product" value="Добавить"/><br>
						</form>
					';
					if (isset($_POST['add_to_product'])) {
						$category_add_product = $_POST['category_add_product'];
						$name_add_product = $_POST['name_add_product'];
						$description_add_product = $_POST['description_add_product'];
						$image_add_product = $_POST['image_add_product'];
						$price_add_product = $_POST['price_add_product'];
						$quantity_add_product = $_POST['quantity_add_product'];
						$composition_add_product = $_POST['composition_add_product'];
						$size_add_product = $_POST['size_add_product'];
						
						$image_add_product_bd = '/images/' . $image_add_product;
						mysql_query("INSERT INTO product (id_category,name_product,description_product,image_product,price_product,quantity_product,composition_product,size_product) VALUES ('".$category_add_product."','".$name_add_product."','".$description_add_product."','".$image_add_product_bd."','".$price_add_product."','".$quantity_add_product."','".$composition_add_product."','".$size_add_product_bd."')",$link);
						
					}
				}elseif ($active == 'change_product'){
					echo'
						<h2>Изменение</h2>
						<form method="post">
						<label>Выберите ID товара</label><input name="id_change_product" type="number"/>
						<input name="select_id_change" type="submit" value="Выбрать"/>
						</form>
					';
					if (isset($_POST['select_id_change'])) {
						$id_change_product = $_POST['id_change_product'];
						$result = mysql_query("SELECT * FROM product WHERE id_product = '".$id_change_product."'",$link);
						if (mysql_num_rows($result) > 0){
							$row = mysql_fetch_array($result);
							do {
								echo '
										<form method="post">
										<label for="category_change_product">*Введите номер категории</label><input name="category_change_product" type="number" value="'.$row['id_category'].'"/><br>
										<label for="name_change_product">*Введите наименование товара</label><input name="name_change_product" type="text" value="'.$row['name_product'].'"/><br>
										<label for="description_change_product">*Введите описание товара</label><input name="description_change_product" value="'.$row['description_product'].'"/><br>
										<label for="image_change_product">*Введите имя картинки(с расширением)</label><input name="image_change_product" type="text" value="'.$row['image_product'].'"/><br>
										<label for="price_change_product">*Введите цену товара</label><input name="price_change_product" type="number" value="'.$row['price_product'].'"/><br>
										<label for="quantity_change_product">*Введите количество товаров на складе</label><input name="quantity_change_product" type="number" value="'.$row['quantity_product'].'"/><br>
										<label for="composition_change_product">*Введите состав букета(если букет)</label><input name="composition_change_product" type="text" value="'.$row['composition_product'].'"/><br>
										<label for="size_change_product">*Введите размер товара(в см.)</label><input name="size_change_product" type="number" value="'.$row['size_product'].'"/><br>
										<input type="submit" name="change_to_product" value="Изменить"/><br>
										</form>
									';
								if (isset($_POST['change_to_product'])){
									$category_change_product = $_POST['category_change_product'];
									$name_change_product = $_POST['name_change_product'];
									$description_change_product = $_POST['description_change_product'];
									$image_change_product = $_POST['image_change_product'];
									$price_change_product = $_POST['price_change_product'];
									$quantity_change_product = $_POST['quantity_change_product'];
									$composition_change_product = $_POST['composition_change_product'];
									$size_change_product = $_POST['size_change_product'];

									mysql_query("UPDATE `product` SET id_product = `$id_change`, id_category = `$category_change_product`, name_product = `$name_change_product`, description_product = `$description_change_product`, image_product = `$image_change_product`, price_product = `$price_change_product`, quantity_product = `$quantity_change_product`, composition_product = `$composition_change_product`, size_product = `$size_change_product` WHERE id_product = `$id_change_product`",$link);
								}
							}
						while ($row = mysql_fetch_array($result));
						}	
					}
				}elseif ($active == 'delete_product'){
					echo'
						<h2>Удаление</h2>
						<form method="post">
						<label>Выберите ID товара</label><input name="id_delete_product" type="number"/>
						<input name="select_id_delete" type="submit" value="Удалить"/>
						</form>
					';
				}	if (isset($_POST['select_id_delete'])){
					$id_delete_product = $_POST['id_delete_product'];
					mysql_query("DELETE FROM product WHERE id_product='".$id_delete_product."'",$link);
				}
				echo '</div>';
		}elseif ($section == 'category') {
echo'
				<table>
					<tr>
						<td>ID Категории</td>
						<td>Нименование категории</td>
					</tr>
			';
				$result = mysql_query("SELECT * FROM category",$link);
				if (mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				do {
				echo '
					<tr>
						<td>'.$row['id_category'].'</td>
						<td>'.$row['name_category'].'</td>
					</tr>
				';
				}
				while ($row = mysql_fetch_array($result));
				}
				echo '
				</table>
				';
				echo '<div class="active_product">
						<h2  align="center">
						<a href="admin.php?section=category&active=add"> Добавить </a>/
						<a href="admin.php?section=category&active=change"> Изменить </a>/
						<a href="admin.php?section=category&active=delete"> Удалить </a>/
						</h2><br>
				';
				if ($active == 'add') {
					echo '
						<h2>Добавление</h2>
						<form method="post">
						<label for="name_add_product">*Введите наименование категории</label><input name="name_add_category" type="text"/><br>
						<input type="submit" name="add_to_category" value="Добавить"/><br>
						</form>
					';
					if (isset($_POST['add_to_category'])) {
						$name_add_category = $_POST['name_add_category'];
						
						mysql_query("INSERT INTO category (name_category) VALUES ('".$name_add_category."')",$link);
						
					}else {
						echo '<h1>Error</h1>';
					}
				}elseif ($active == 'change'){
					echo'
						<h2>Изменение</h2>
						<form method="post">
						<label>Выберите ID категории</label><input name="id_change_category" type="number"/>
						<input name="select_id_change_category" type="submit" value="Выбрать"/>
						</form>
					';
					if (isset($_POST['select_id_change_category'])) {
						$id_change_category = $_POST['id_change_category'];
						$result = mysql_query("SELECT * FROM category WHERE id_category = '".$id_change_category."'",$link);
						if (mysql_num_rows($result) > 0){
							$row = mysql_fetch_array($result);
							do {
								echo '
										<form method="post">
										<label for="category_change_product">*Введите наименование категории</label><input name="category_change" type="text" value="'.$row['name_category'].'"/><br>
										<input type="submit" name="change_to_category" value="Изменить"/><br>
										</form>
									';
								if (isset($_POST['change_to_category'])){
									$category_change = $_POST['category_change'];

									mysql_query("UPDATE `category` SET `name_category`= $category_change  WHERE `id_category` = $id_change_category",$link);
									
								}
							}
						while ($row = mysql_fetch_array($result));
						}	
					}
				}elseif ($active == 'delete'){
					echo'
						<h2>Удаление</h2>
						<form method="post">
						<label>Выберите ID категории</label><input name="id_delete_category" type="number"/>
						<input name="select_id_delete_category" type="submit" value="Удалить"/>
						</form>
					';
					if (isset($_POST['select_id_delete_category'])){
					$id_delete_category = $_POST['id_delete_сategory'];
					mysql_query("DELETE FROM category WHERE id_category='".$id_delete_category."'",$link);
				}	
				}
				echo '</div>';
		}elseif ($section == 'order') {
					echo'
				<table>
					<tr>
						<td>ID Заказа</td>
						<td>ID Корзины</td>
						<td>ФИО покупателя</td>
						<td>Способ доставки</td>
						<td>Способ оплаты</td>
						<td>Адрес покупателя</td>
						<td>Номер телефона покупателя</td>
						<td>Почта покупателя</td>
						<td>Комментарий к заказу</td>
						<td>Сумма заказа</td>
						<td>Подтверждение заказа</td>
					</tr>
			';
				$result = mysql_query("SELECT * FROM `order` ",$link);
				if (mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				do {
					echo '
					<tr>
						<td>'.$row['id_order'].'</td>
						<td>'.$row['id_basket'].'</td>
						<td>'.$row['fio_order'].'</td>
						<td>'.$row['delivery_order'].'</td>
						<td>'.$row['payment_order'].'</td>
						<td>'.$row['address_order'].'</td>
						<td>'.$row['number_order'].'</td>
						<td>'.$row['email_order'].'</td>
						<td>'.$row['comment_order'].'</td>
						<td>'.$row['amount_order'].'</td>
						<td>'.$row['confirmed_order'].'</td>
					</tr>
					
				';
				}
				while ($row = mysql_fetch_array($result));
				}
				echo'</table>';
				echo '<div class="active_product">
						<h2  align="center">
						<a href="admin.php?section=order&active=view"> Показать корзину </a>/
						<a href="admin.php?section=order&active=accept"> Подтвердить </a>
						</h2><br>
				';
				if ($active == 'view') {
					echo '
						<h2>Корзина</h2>
						<form method="post">
						<label for="name_add_product">*Введите номер корзины</label><input name="number_basket" type="number"/><br>
						<input type="submit" name="view_basket" value="Показать"/><br>
						</form>
					';
					if (isset($_POST['view_basket'])) {
						$number_basket = $_POST['number_basket'];
						echo'
				<table>
					<tr>
						<td>ID Корзины</td>
						<td>Наименование товара</td>
						<td>Количество товара</td>
					</tr>
			';
				$result = mysql_query("SELECT * FROM product_basket, product WHERE product.id_product = product_basket.id_product AND id_basket='$number_basket'",$link);
				if (mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				do {
					echo '
					<tr>
						<td>'.$row['id_basket'].'</td>
						<td>'.$row['name_product'].'</td>
						<td>'.$row['quantity_product_basket'].'</td>
					</tr>
				';
				}
				while ($row = mysql_fetch_array($result));
				}
						
					}
				}elseif ($active == 'change'){
					echo'
						<h2>Изменение</h2>
						<form method="post">
						<label>Выберите ID категории</label><input name="id_change_category" type="number"/>
						<input name="select_id_change_category" type="submit" value="Выбрать"/>
						</form>
					';
					if (isset($_POST['select_id_change_category'])) {
						$id_change_category = $_POST['id_change_category'];
						$result = mysql_query("SELECT * FROM category WHERE id_category = '".$id_change_category."'",$link);
						if (mysql_num_rows($result) > 0){
							$row = mysql_fetch_array($result);
							do {
								echo '
										<form method="post">
										<label for="category_change_product">*Введите номер категории</label><input name="category_change" type="text" value="'.$row['name_category'].'"/><br>
										<input type="submit" name="change_to_category" value="Изменить"/><br>
										</form>
									';
								if (isset($_POST['change_to_category'])){
									$category_change = $_POST['category_change'];

									mysql_query("UPDATE `category` SET `name_category`= $category_change  WHERE `id_category` = $id_change_category",$link);
									
								}
							}
						while ($row = mysql_fetch_array($result));
						}	
					}
				}elseif ($active == 'accept'){
					
					echo'
					<h2>Подтверждение</h2>
				<form method="post">
				<label>Введите номер заказа</label><input type="number" name="id"/>
				<input type="submit" name="test" value="Подтвердить"/>
				</form>
				';
				if (isset($_POST['test'])){
					$id = $_POST['id'];
					mysql_query("UPDATE `order` SET `confirmed_order`= 1 WHERE `id_order` = $id",$link);
				}
				}
		}elseif ($section == 'auth') {
				echo'
				<form method="post">
				<label>Введите старый пароль</label><input name="old" input="text"/>
				<label>Введите новый пароль</label><input name="new" input="text"/>
				<input type="submit" name="new_pass" value="Поменять"/>
				</form>
				';
				if(isset($_POST['new_pass'])) {
					$old = $_POST['old'];
					$new = $_POST['new'];
					$result = mysql_query("SELECT * from admin",$link);
					if (mysql_num_rows($result) > 0){
							$row = mysql_fetch_array($result);
							do {
								if ($old != $row['password_admin']) {
									echo'<h1>Не верно введен старый пароль</h1>';
								} else {
									mysql_query("UPDATE `admin` SET `password_admin`= $new ",$link);
									echo'<h1>Пароль успешно изменен!</h1>';
								}
								}
							
						while ($row = mysql_fetch_array($result));
						}	
				}
		}
	?>
	</div>
</body>
</html>
