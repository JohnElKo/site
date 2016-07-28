<?php
require_once 'connect.php';

		if ($_POST['id2'] != '' && $_POST['Name2'] != '' && $_POST['Date2'] != '' && isset($_POST['id2']) && isset($_POST['Name2']) && isset($_POST['Date2'])) {
    // Изменяем запись в таблице "table1"
		$qr_update = mysqli_query ($connect_to_db, "UPDATE crm SET Name = '".$_POST['Name2']."', Date = '".$_POST['Date2']."', content = '".$_POST['content1']."'  where id = '".$_POST['id2']."'")
		or die(mysqli_error());
	}
	?>
<form action="index2.php" method="post">
	<input type="submit" value="Вернуться" class="btn btn-info btn-sm" >
</form>