<?php

// Подключаем класс для работы с базой данных
$db = require_once "classes/DB.php";

// Создаём объект класса
$nbd = new DB();

// Выбираем список всех контактов
$zapr = $nbd->query("select * from phones");

// Создаём пустой массив
$rows = [];

// Заполняем массив
foreach ($zapr as $za){
    $rows[] = $za;
}

// Отдаём данные на фронт
echo json_encode($rows);

?>
