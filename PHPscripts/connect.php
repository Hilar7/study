<?php
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "deutschprofi";

// создаю соединение
$conn = new mysqli($host, $username, $password, $dbname);

// проверяю соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// устанавливаю кодировку utf8
$conn->set_charset("utf8");
?>