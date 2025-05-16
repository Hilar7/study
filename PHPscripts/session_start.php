<?php
// Стартую сессию для отслеживания пользователей
session_start();

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "deutschprofi";

// Создаю соединение
$conn = new mysqli($host, $username, $password, $dbname);

// Проверяю соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Устанавливаю кодировку utf8
$conn->set_charset("utf8");

// Функция для создания гостевого пользователя
function createGuestUser($conn) {
    // Проверяю, не создан ли уже гость в этой сессии
    if (!isset($_SESSION['guest_created'])) {
        // Вставляю запись гостя в БД
        $stmt = $conn->prepare("INSERT INTO users (role, created_at) VALUES ('guest', NOW())");
        $stmt->execute();
        $stmt->close();
        
        // Помечаю сессию, чтобы не создавать повторно
        $_SESSION['guest_created'] = true;
    }
}
?>