<?php


$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$price = $_POST['price']; 

if (isset($_POST['name'])) {
$a = $_REQUEST['name'];
} else {
echo 'Поле не заполнено';
}

if (isset($_POST['phone'])) {
$a = $_REQUEST['phone'];
} else {
echo 'Поле не заполнено';
}

if (isset($_POST['email'])) {
$a = $_REQUEST['email'];
} else {
echo 'Поле не заполнено';
}

if (isset($_POST['price'])) {
$a = $_REQUEST['price'];
} else {
echo 'Поле не заполнено';
}

$to = "Element194@yandex.ru";

$subject = "Новый клиент";
$message = "<br> Имя: ".$name."<br>Телефон: ".$phone. "<br>email: ".$email. "<br> цена: ".$price;
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: Postel \r\n";

@mail($to, $subject, $message, $headers);

$roistatData = array(
    'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
    'key'     => 'MTg4Nzg6MjEwNzM6N2FiNmMwZWMxODcwNjU1OWQ2Y2QyMzVjZTY5MjYyNWU=', // Замените SECRET_KEY на секретный ключ из пункта меню Настройки -> Интеграция со сделками в нижней части экрана и строчке Ключ для интеграций
    'title'   => 'Новая',
    'comment' => 'Комментарий к сделке',
    'name'    => 'Имя клиента',
    'email'   => 'client@email.com',
    'phone'   => '79111234567',
    'is_need_callback' => '0', // Для автоматического использования обратного звонка при отправке контакта и сделки нужно поменять 0 на 1
    'fields'  => array(
    // Массив дополнительных полей, если нужны, или просто пустой массив. Более подробно про работу доп. полей можно посмотреть в видео в начале статьи
    // Примеры использования:
        "price" => 123 // Поле бюджет в amoCRM
    )
);
  
file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));

echo "Данные отправлены";

?>