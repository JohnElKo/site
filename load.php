<?php

 // определяем начальные данные
	$db_host = 'localhost';
	$db_name = 'BD_proba';
	$db_username = 'root';
 //   $db_password = 'admin09876';
	$db_table_to_show = 'files';

    // соединяемся с сервером базы данных
	$connect_to_db = mysqli_connect($db_host, $db_username)
	or die("Could not connect: " . mysqli_error($connect_to_db));

    // подключаемся к базе данных
	$files = mysqli_select_db($connect_to_db, $db_name)
	or die("Could not select DB: " . mysqli_error($files));



  if($_FILES["filename"]["size"] > 1024*30*1024)
   {
     echo ("Размер файла превышает 30 мегабайт");
     exit;
   }

   if(is_uploaded_file($_FILES["filename"]["tmp_name"])) {
    // Добавляем запись в таблицу 
		$qr_add = mysqli_query ($connect_to_db, "INSERT INTO files (f_name) values ('".$_FILES["filename"]["name"]."')")
		or die(mysqli_error($connect_to_db));
	   } 
	   else {
      echo("Ошибка загрузки файла");
   } 

$f = mysqli_real_query ($connect_to_db, "SELECT id FROM files ORDER BY id DESC LIMIT 1");
echo $f;
     move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__."/user_files/".$_FILES["filename"]["name"]);
	$file_ext=strtolower(strrchr($_FILES['filename']['name'],'.')); // записывает в переменную разширение файла
	$_FILES['userfile']['name'] = str_replace(' ', '_', $_FILES['filename']['name']); // убирает пробелы в имени
     rename(__DIR__."/user_files/".$_FILES["filename"]["name"], __DIR__."/user_files/".$f.$file_ext); // меняет имя файла

?>

<form action="load.html" method="post">
	<input type="submit" value="Вернуться" class="btn btn-info btn-sm" >
</form>