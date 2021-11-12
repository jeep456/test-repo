<?php

// получаем значение id с главной страницы
$id = $_POST["id"];

// подключаем главный класс работы с базой данных
$db = require_once "classes/DB.php";

// создаём объект
$ndb = new DB();

// Создаём sql запрос
$delSql = "DELETE FROM phones WHERE id=?";

// Вызываем метод удаления записи
$ndb->delete($delSql,$id);

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
