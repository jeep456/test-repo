<?php

// Подключаем класс для работы с базой данных
$db = require_once "classes/DB.php";

// Создаём объект класса
$ndb = new DB();

// Вызывам метод класса DB для автозаполнения таблицы
$ndb->autoCompleteDB();

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
