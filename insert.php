<?php

// Подключаем класс для работы с базой данных
$db = require_once "classes/DB.php";

// Создаём объект класса
$ndb = new DB();

// Получаем входные данные
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$bankof = $_POST['bankof'];


// Подготавливаем запрос и данные для вставки в таблицу базы данных
$insSql = "INSERT INTO phones (fullname,phone,bankof) VALUES (?,?,?)";
$insData = [$fullname,$phone,$bankof];

// Вызываем метод вставки в базу и добавляем запись
$ndb->insert($insSql,$insData);


// Получаем список всех контактов
$getAlls = $ndb->query("SELECT * FROM phones;");

// Подготавливаем массив
$rows = [];

// Заполняем массив
foreach ($getAlls as $getAll) {
    $rows[] = $getAll;
}

// Посылаем массив на фронт
echo json_encode($rows);

?>
