<?php
require_once 'connect.php';

	if (isset($_POST['pName']) == false || $_POST['pName'] == 'all' || $_POST['pName'] =='') {
    // выбираем все значения из таблицы "table1"
		$qr_result = mysqli_query($connect_to_db, "select * from " . $db_table_to_show)
		or die(mysqli_error($connect_to_db));
	}
	else {
		$qr_result = mysqli_query($connect_to_db, "select * from " . $db_table_to_show. " where name ='".$_POST['pName']."'")
		or die(mysqli_error($connect_to_db));
	}
?>