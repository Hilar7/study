<?php // HTTP заголовок
header('Content-Type: application/json'); 

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "deutschprofi";

try {
    // Создаю подключение
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Получаю данные из POST запроса
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Начинаю транзакцию
    $conn->beginTransaction();
    
    //Вставляю данные в таблицу consultclient
    $stmt = $conn->prepare("INSERT INTO consultclient (SecondName, FirstName, MiddleName) VALUES (:lastName, :firstName, :middleName)");
    $stmt->execute([
        ':lastName' => $data['lastName'],
        ':firstName' => $data['firstName'],
        ':middleName' => $data['middleName']
    ]);
    
    // Получаю ID только что вставленной записи
    $clientId = $conn->lastInsertId();
    
    //Вставляю данные в таблицу consultation
    $stmt = $conn->prepare("INSERT INTO consultation (ConsultClient_ID, Email, Phone_Number) VALUES (:clientId, :email, :phone)");
    $stmt->execute([
        ':clientId' => $clientId,
        ':email' => $data['email'],
        ':phone' => $data['phone']
    ]);
    
    // Подтверждаю транзакцию
    $conn->commit();
    
    echo json_encode(['success' => true]);
    
} catch(PDOException $e) {
    // Откатываю транзакцию в случае ошибки
    if (isset($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>