<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Создание сделки</title>

	<link rel="stylesheet" type="text/css" href="main.css" media="all">
	<link href="css/bootstrap.css" rel="stylesheet">

</head>
<body>

	<script type="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="js/bootstrap.js"></script>

	<?php
	require_once 'connect.php';
	require_once 'select.php';
	?>


	<div >
		<table>
			<tr>
				<td>
					<table class="table table table-hover table-condensed">
						<thead>
							<tr>
								<td>ID</td>
								<td>Name</td>
								<td>Phone</td>
								<td>Email</td>
								<td>Price</td>
							</tr>
						</thead>
						<tbody> 
							<?php
							while($data = mysqli_fetch_array($qr_result)){ 
								?>
								<tr>	
									<td><?php echo $data['id'] ?></td>
									<td><?php echo $data['Name'] ?></td>
									<td><?php echo $data['Phone'] ?></td>
									<td><?php echo $data['Email'] ?></td>
									<td><?php echo $data['Price'] ?></td>
									<td><?php echo $data['id_f'] ?></td>									
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div>



	<form action="select.php" method="post">
		<input type="text" name="pName" placeholder="Поиск">
		<input type="submit" value="Поиск" class="btn btn-info btn-sm" >
	</form>
	<br>
	<form action="del.php" method="post">
		<input type="text" name="id2" placeholder="id">
		<input type="submit" value="Удалить" class="btn btn-danger btn-sm">
	</form>

	<br>
	<form action="update.php" method="post">
		<input type="text" name="id3" placeholder="id">
		<input type="text" name="name3" placeholder="Name">
		<input type="text" name="phone3" placeholder="Phone">
		<input type="text" name="email3" placeholder="Email">			
		<input type="text" name="price3" placeholder="Price">			
		<input type="submit" value="Изменить" class="btn btn-warning btn-sm">	
	</form>



	<div class="container table-responsive">
		<div id="wrapper">
			<header>
				<h1>Создание сделки</h1>
			</header>
			<div id="contact_form">
				<form enctype="multipart/form-data" action="handler.php" method="post">
					<div class="field">
						<label for="contact_name">Имя</label><input id="contact_name" type="text" name="name">
					</div>
					<div class="field">
						<label for="contact_phone">Телефон</label><input id="contact_phone" type="tel" name="phone">
					</div>
					<div class="field">
						<label for="contact_email">E-mail</label><input id="contact_email" type="email" name="email">
					</div>
					<div class="field">
						<label for="price">Цена</label><input id="price" type="text" name="price">
					</div>
					<div>
							<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
							<input type="hidden" name="MAX_FILE_SIZE" value="300000">
							<!-- Название элемента input определяет имя в массиве $_FILES -->
							<input name="filename" type="file">
					</div>
						<button type="submit" class="btn btn-success btn-sm">Создать сделку</button>
					</div>
				</form>
			</div>
		</div>
	</body>
	</html>