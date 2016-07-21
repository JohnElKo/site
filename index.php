<?php 
/*
	$a = 1; // integer
	$b = 1.2; // float
	$s = 'Hello'; // string
	$arr1 = [ 1, 2, 3, 4];
	$arr2  = array ('a' => 1, 'c' => 'abc' );

	echo $a . '<br>';
	echo $b . '<br>';
	echo $s . '<br>';
	print_r ($arr1) . '<br>' . '<br>';
	print_r ($arr2); */

/*
function hello($a, $b) {
	echo $a + $b;
}

$func = function () {
	echo 'privet';
};
$func(); */
/*
	for ($i=0; $i <= 10; $i++) { 
		echo $i. '<br>';
	}
*/
/*
$arr = [2, 4, 1, -10, 'abc', 100];
$count = count($arr);

for ($i=0; $i < $count; $i++) { 
	echo $arr[$i]. '<br>';
};
*/
 /*
	if (1<2) {
		echo 'Yes';
	}
	elseif (2>1) {
		 'No!!!';
	}
*/
/*	$a = 'xpen1';
	switch ($a) {
		case 'xpen2':
			echo "Вот это поворот";
			break;
		
		default:
			echo 'Братух, не нашёл';
			break;
	}
*/

/*
$m  = array ('a' => 'Питер', 'b' => 'Москва', 'c' => 'Колокола' );
//$m = ['Питер', 'Москва', 'Колокола'];
$k = count($m);

for ($i=0; $i < $k; $i++) { 
	if ($m['a'] == 'Колокола') {
		echo 'Нашёл!'. '<br>';
	}
	else {
		print_r ($m['a']);
		echo ' - Не то'. '<br>';

	}
}
*/
/*
	echo ( 1 > 2 ) ? 'yes' : 'no';
*/


/* 		ЗАДАНИЕ РОМЫ

    // определяем начальные данные
    $db_host = 'localhost';
    $db_name = 'BD_proba';
    $db_username = 'root';
    // #$db_password = 'admin09876';
    $db_table_to_show = 'table1';

    // соединяемся с сервером базы данных
    $connect_to_db = mysql_connect($db_host, $db_username)
    or die("Could not connect: " . mysql_error());

    // подключаемся к базе данных
    mysql_select_db($db_name, $connect_to_db)
    or die("Could not select DB: " . mysql_error());

    // выбираем все значения из таблицы "student"
    $qr_result = mysql_query("select * from " . $db_table_to_show)
    or die(mysql_error());

    // выводим на страницу сайта заголовки HTML-таблицы
    echo '<table>'; // border="1">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>id</th>';
  echo '<th>Name</th>';
  echo '<th>Date</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
   // выводим в HTML-таблицу все данные клиентов из таблицы MySQL 
  while($data = mysql_fetch_array($qr_result)){ 
    echo '<tr>';
    echo '<td>' . $data['id'] . '</td>';
    echo '<td>' . $data['Name'] . '</td>';
    echo '<td>' . $data['Date'] . '</td>';
    echo '</tr>';
  }
  
    echo '</tbody>';
  echo '</table>';



?>

<form action="" method="post">
Имя: <input type="text" name="Name">
         <input type="submit" value="OK">
</form>


<?php

 $qr_result  = mysql_query("select * from `table1` where 'name' = '" . mysql_escape_string($_POST['Name']) . "'");

  // выводим на страницу сайта заголовки HTML-таблицы
    echo '<table>'; // border="1">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>id</th>';
  echo '<th>Name</th>';
  echo '<th>Date</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
   // выводим в HTML-таблицу все данные клиентов из таблицы MySQL 
  while($data = mysql_fetch_array($qr_result)){ 
    echo '<tr>';
    echo '<td>' . $data['id'] . '</td>';
    echo '<td>' . $data['Name'] . '</td>';
    echo '<td>' . $data['Date'] . '</td>';
    echo '</tr>';
  }
  
    echo '</tbody>';
  echo '</table>';

like %

*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Мой блок</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="wrapper">
		<div class="header"></div>
		<div class="content"></div>
		<div class="footer"></div>
	</div>	
</body>
</html>
