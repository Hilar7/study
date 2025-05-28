<?php
// Я начинаю сессию, чтобы сохранять состояние между запросами
session_start();

// Этот блок обрабатывает выбор пользователя по поводу политики конфиденциальности
// Я проверяю, был ли передан параметр privacy_choice в GET-запросе
if (isset($_GET['privacy_choice'])) {
    if ($_GET['privacy_choice'] === 'accept') {
        //в случае accept ставлю флаг принятия в сессии
        $_SESSION['privacy_accepted'] = true;
        // И сбрасываю флаг отказа
        $_SESSION['privacy_rejected'] = false;
    } 
    // Если пользователь отклонил политику конфиденциальности
    elseif ($_GET['privacy_choice'] === 'reject') {
        // Я устанавливаю флаг отказа в сессии
        $_SESSION['privacy_rejected'] = true;
        // И сбрасываю флаг принятия
        $_SESSION['privacy_accepted'] = false;
    }

    exit;
}

// Этот блок выполняется только если пользователь не отказался от политики
//проверяю, не установлен ли флаг отказа в сессии
if (!isset($_SESSION['privacy_rejected']) || $_SESSION['privacy_rejected'] !== true) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "deutschprofi";

    try {
        //создаю подключение к БД
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //устанавливаю режим обработки ошибок - исключения
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //получаю IP-адрес пользователя
        $ip_address = $_SERVER['REMOTE_ADDR'];
        //получаю информацию о браузере пользователя
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        //подготавливаю запрос для проверки, был ли этот посетитель уже записан за последний час
        $check = $conn->prepare("SELECT id FROM visitors 
                               WHERE ip_address = :ip_address 
                               AND visit_time > NOW() - INTERVAL 1 HOUR 
                               LIMIT 1");
        //привязываю параметр IP-адреса к запросу
        $check->bindParam(':ip_address', $ip_address);
        $check->execute();
        
        // Если такого посетителя за последний час не было
        if ($check->rowCount() == 0) {
            //выполняю запрос на добавление нового посетителя в БД
            $stmt = $conn->prepare("INSERT INTO visitors (ip_address, user_agent) 
                                  VALUES (:ip_address, :user_agent)");
            //привязываю параметры IP-адреса и User-Agent
            $stmt->bindParam(':ip_address', $ip_address);
            $stmt->bindParam(':user_agent', $user_agent);
            $stmt->execute();
        }
        
    } catch(PDOException $e) {
    }
}
?>
