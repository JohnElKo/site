<?php
require_once 'connect.php';
require_once 'add.php';

	if ($_POST['name'] != '' && $_POST['phone'] != '' && $_POST['email'] != '' && $_POST['price'] != ''&& isset($_POST['name'])&& isset($_POST['phone'])  && isset($_POST['email']) && isset($_POST['price'])) {
    // Добавляем запись в таблицу */
		$qr_add = mysqli_query ($connect_to_db, "INSERT INTO crm (name, phone, email, price, id_f) values ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['email']."', '".$_POST['price']."', '".$f."')")
		or die(mysqli_error($connect_to_db));

	}

	?>
<form action="add2.php" method="post">
<input type="submit" value="далее" class="btn btn-info btn-sm" >
</form>