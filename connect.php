<?php

 // определяем начальные данные
	$db_host = 'localhost';
	$db_name = 'BD_proba';
	$db_username = 'root';
 //   $db_password = 'admin09876';
	$db_table_to_show = 'crm';

    // соединяемся с сервером базы данных
	$connect_to_db = mysqli_connect($db_host, $db_username)
	or die("Could not connect: " . mysqli_error($connect_to_db));

    // подключаемся к базе данных
	$crm = mysqli_select_db($connect_to_db, $db_name)
	or die("Could not select DB: " . mysqli_error($crm));

?>