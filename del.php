<?php
require_once 'connect.php';
	if ($_POST['id2'] != '' && isset($_POST['id2'])) {
    // Удаляем запись из таблицы "table1"
		$qr_delete = mysqli_query ($connect_to_db, "DELETE FROM crm where id = ".$_POST['id2'])
		or die(mysqli_error());
	}
//echo '<meta http-equiv="refresh" content="0; url=http://localhost/mysite/index2.php">';

?>
<form action="index2.php" method="post">
	<input type="submit" value="Вернуться" class="btn btn-info btn-sm" >
</form>
	