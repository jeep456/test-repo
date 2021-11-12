<?php

// Получаем id редактируемой записи
$id = $_POST['id'];

// Получаем редактируемые значения
$fullname   = $_POST['editfullname'];
$phone      = $_POST['editphone'];
$bankof     = $_POST['editbankof'];

// Подключаем класс для работы с базой данных
$db = require_once "classes/DB.php";

// Создаём объект класса
$ndb = new DB();

// Подготавливаем запрос и данные для обновления
$updSql = "UPDATE phones SET fullname=?, phone=?, bankof=? WHERE id=?";
$updData = [$fullname,$phone,$bankof,$id];

// Вызаваем метод обнолвения и обновляем
$ndb->update($updSql,$updData);

// Получаем список всех пользователей
$getAlls = $ndb->query("SELECT * FROM phones;");

// Подготавливаем массив
$rows = [];

// Перебираем результат из базы и добавляем в массив
foreach ($getAlls as $getAll) {
    $rows[] = $getAll;
}

// Возвращаем массив на главную страницу
echo json_encode($rows);
