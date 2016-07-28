<?php
require_once 'connect.php';

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

     move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__."/user_files/".$_FILES["filename"]["name"]);
	$file_ext=strtolower(strrchr($_FILES['filename']['name'],'.')); // записывает в переменную разширение файла
	$_FILES['userfile']['name'] = str_replace(' ', '_', $_FILES['filename']['name']); // убирает пробелы в имени
     rename(__DIR__."/user_files/".$_FILES["filename"]["name"], __DIR__."/user_files/".$f.$file_ext); // меняет имя файла

$clear = mysqli_free_result($qr_add);
//$qr_add = mysqli_free_result($qr_add);


	if ($_POST['name'] != '' && $_POST['phone'] != '' && $_POST['email'] != '' && $_POST['price'] != ''&& isset($_POST['name'])&& isset($_POST['phone'])  && isset($_POST['email']) && isset($_POST['price'])) {
    // Добавляем запись в таблицу */
		$qr_add1 = mysqli_query ($connect_to_db, "INSERT INTO crm (name, phone, email, price, id_f) values ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['email']."', '".$_POST['price']."', '".$f."')")
		or die(mysqli_error($connect_to_db));

	}

?>
<form action="index2.php" method="post">
	<input type="submit" value="Вернуться" class="btn btn-info btn-sm" >
</form>