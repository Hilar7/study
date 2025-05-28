<?php
// начинаю сессию
session_start();

//проверяю, был ли передан параметр 'choice' в GET-запросе
if (isset($_GET['choice'])) {
    // Если значение параметра 'choice' равно 'accept' (пользователь принял условия)
    if ($_GET['choice'] === 'accept') {
        //устанавливаю флаг 'privacy_accepted' в сессии в true
        $_SESSION['privacy_accepted'] = true;
        //удаляю возможный флаг отказа, если он был установлен ранее
        unset($_SESSION['privacy_rejected']);
    } 
    // Иначе, если значение параметра 'choice' равно 'reject' (пользователь отклонил условия)
    elseif ($_GET['choice'] === 'reject') {
        //устанавливаю флаг 'privacy_rejected' в сессии в true
        $_SESSION['privacy_rejected'] = true;
        //удаляю возможный флаг принятия, если он был установлен ранее
        unset($_SESSION['privacy_accepted']);
    }

}
?>