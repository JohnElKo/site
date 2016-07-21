<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Кнопочки</title>
	 <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>


<script type="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="js/bootstrap.js"></script>


<?php
 // определяем начальные данные
	$db_host = 'localhost';
	$db_name = 'BD_proba';
	$db_username = 'root';
    // #$db_password = 'admin09876';
	$db_table_to_show = 'table1';

    // соединяемся с сервером базы данных
	$connect_to_db = mysqli_connect($db_host, $db_username)
	or die("Could not connect: " . mysqli_error());

    // подключаемся к базе данных
	mysqli_select_db($connect_to_db, $db_name)
	or die("Could not select DB: " . mysqli_error());


	if ($_POST['Name1'] != '' && $_POST['Date1'] != '' && isset($_POST['Name1']) && isset($_POST['Date1'])) {
    // Добавляем запись в таблицу "table1"
		$qr_add = mysqli_query ($connect_to_db, "INSERT INTO table1 (id, Name, Date, content) values ('".$_POST['id1']."', '".$_POST['Name1']."', '".$_POST['Date1']."', '".$_POST['content1']."')")
		or die(mysqli_error());
	}

	if ($_POST['ID1'] != '' && isset($_POST['ID1'])) {
    // Удаляем запись из таблицы "table1"
		$qr_delete = mysqli_query ($connect_to_db, "DELETE FROM table1 where id = ".$_POST['ID1'])
		or die(mysqli_error());
	}

		if ($_POST['id2'] != '' && $_POST['Name2'] != '' && $_POST['Date2'] != '' && isset($_POST['id2']) && isset($_POST['Name2']) && isset($_POST['Date2'])) {
    // Изменяем запись в таблице "table1"
		$qr_update = mysqli_query ($connect_to_db, "UPDATE table1 SET Name = '".$_POST['Name2']."', Date = '".$_POST['Date2']."', content = '".$_POST['content1']."'  where id = '".$_POST['id2']."'")
		or die(mysqli_error());
	}

	if (isset($_POST['pName']) == false || $_POST['pName'] == 'all' || $_POST['pName'] =='') {
    // выбираем все значения из таблицы "table1"
		$qr_result = mysqli_query($connect_to_db, "select * from " . $db_table_to_show)
		or die(mysqli_error());
	}
	else {
		$qr_result = mysqli_query($connect_to_db, "select * from " . $db_table_to_show. " where name ='".$_POST['pName']."'")
		or die(mysqli_error());
	}

	?>
<div class="container table-responsive">
<table>
<tr>><td>
	<table class="table table table-hover table-condensed">
		<thead>
			<tr>
				<td>ID</td>
				<td>name</td>
				<td>Date</td>
				<td>Image</td>
			</tr>
		</thead>
		<tbody> 
			<?php
			while($data = mysqli_fetch_array($qr_result)){ 
				?>
				<tr>	
					<td><?php echo $data['id'] ?></td>
					<td><?php echo$data['Name'] ?></td>
					<td><?php echo$data['Date'] ?></td>
					<td><?php echo$data['content'] ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	</td>
	<td><img src="https://pp.vk.me/c630818/v630818714/22848/b50wwYI3Qhw.jpg" class="img-rounded"></td>
	</tr>
</table>

	<form action="index1.php" method="post">
		<input type="text" name="pName" placeholder="Поиск..">
		<input type="submit" value="Поиск" class="btn btn-info btn-sm" >

		<table class="nth-child">
			<tr>
				<td>
					<input type="text" name="id1">				
					<input type="text" name="Name1">
					<input type="text" name="Date1">
					<form enctype="multipart/form-data" method="post" action="image.php">
					<input type="file" name="container">
					</form>
					<input type="submit" value="Добавить" class="btn btn-success btn-sm">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="ID1">
					<input type="submit" value="Удалить" class="btn btn-danger btn-sm">
				</td>
			</tr>
						<tr>
				<td>
					<form class="form-inline">
					<input type="text" name="id2">
					<input type="text" name="Name2">
					<input type="text" name="Date2">
					<input type="submit" value="Изменить" class="btn btn-warning btn-sm">	
					</form>
				</td>
			</tr>
		</table>
</div>

	</form>

</body>
</html>