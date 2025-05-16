<!DOCTYPE html>
<html lang="ru">
<head>   
<link rel="icon" href="img/logo.svg" type="image/svg+xml">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deutsch Profi</title>
 
    <link rel="stylesheet" href="styles/HeaderAndMain.css">
    <link rel="stylesheet" href="styles/Block1.css">
    <link rel="stylesheet" href="styles/Block2.css">
    <link rel="stylesheet" href="styles/Block3.css">
    <link rel="stylesheet" href="styles/Block4.css">
    <link rel="stylesheet" href="styles/Block5.css">
    <link rel="stylesheet" href="styles/CommentBlock.css">
    <link rel="stylesheet" href="styles/Footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <!-- подключение стилевого файла фреймворка bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--подключение скриптового файла библиотеки jquery, необходимого для работы фреймворка-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!--подключение скриптового файла библиотеки popper, необходимого для работы фреймворка-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- подключение скриптового файла фреймворка bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   <div class="loader">
        <div class="loader-inner">
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
        </div>
    </div> 
    <div class="MainFrame"> <!--Главный фрейм -->
    <div class="WebsitePanel"> <!-- Панель сайта-->
        <div class="Header">
            <div class="LogoName">
                <img src="img/logo.svg" alt="" class="Logo" onclick="location.reload();">
                <div class="NameBlock">
                    <h1 class="Name">Deutsch <br> Profi</h1>
                </div>
            </div>
            
            <!-- Десктопное меню -->
            <div class="Nav d-none d-md-flex">
                <a href="#about-lessons" class="NavButton1">Компетенции</a>
                <a href="#about-method" class="NavButton2">О занятиях</a>
                <a href="#ConsultReg" class="NavButton3">Онлайн-запись</a>
                <a href="#reviews" class="NavButton4">Отзывы</a>
            </div>
            
            <!-- Мобильное бургер-меню -->
            <label class="mobile-menu d-block d-md-none">
                <input type="checkbox" id="burger-toggle">
                <span class="menu"><span class="hamburger"></span></span>
                <ul class="burger-nav">
                    <li><a href="#about-lessons" class="burger-link">Компетенции</a></li>
                    <li><a href="#about-method" class="burger-link">О занятиях</a></li>
                    <li><a href="#ConsultReg" class="burger-link">Онлайн-запись</a></li>
                    <li><a href="#reviews" class="burger-link">Отзывы</a></li>
                </ul>
            </label>
        </div>
        <div class="Block1"> <!--1-й блок-->
            <div class="ImgBlock1"></div>
            <div class="TextAndButtonBlock1">
                <div class="TextBlock1Father">
                <div class="TextBlock1">
                    <h2 class="Block1Text1">Онлайн-школа немецкого языка  “Deutsch Profi”.</h2>
                </div>
                <div class="Text2Block1">
                    <p class="Block1Text2">Заговори на немецком свободно — первое занятие бесплатно!</p>
                </div></div>  
            <a href="#ConsultReg"><button class="RegOnConsultationButton1">Хочу на бесплатное занятие!</button></a>
        
        </div>
        </div>
    <div class="Block2" id="about-lessons"> <!-- 2-й блок -->
    <div class="TextBlock2Father">
        <div class="Text1Block2">
            <p class="TextInBlock2">Занятия немецким языком с нами удобны,<br> интересны и результативны.</p>
        </div>
        <div class="Text2Block2">
            <p class="TextInBlock2">Наши педагоги помогут вам:</p>
        </div>
    </div>
    <div class="Block2Father">
    
        <?php  include 'PHPscripts/connect.php';  //подключение к БД
        
        $sql = "SELECT Text FROM competence ORDER BY ID";// Получаю компетенции из таблицы
        $result = $conn->query($sql);
        
        // Проверяю, есть ли результаты
        if ($result->num_rows > 0) {
            // Преобразую в массив
            $competence = array();
            while($row = $result->fetch_assoc()) {
                $competence[] = $row['Text'];
            }
            
            // Проверяю, что кол-во компетенций соответствует минимальному значению
            if (count($competence) >= 6) {
        ?>
        
        <div class="LeftSideBlock2">
            <div class="HelpBlock">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[0]) ?></p></div>
            </div>
            <div class="HelpBlockMiddle">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[1]) ?></p></div>
            </div>
            <div class="HelpBlock">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[2]) ?></p></div>
            </div>
        </div>

        <div class="ImgBlock2"></div>

        <div class="RightSideBlock2">
            <div class="HelpBlockMiddle">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[3]) ?></p></div>
            </div>
            <div class="HelpBlock">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[4]) ?></p></div>
            </div>
            <div class="HelpBlockMiddle">
                <div class="HelpBlockInner"><p class="HelpBlockText"><?= htmlspecialchars($competence[5]) ?></p></div>
            </div>
        </div>
        
        <?php // если компетенций недостаточно, то выводит ошибку
            } else {
                echo '<p>Недостаточно компетенций в БД (необходимо 6, найдено '.count($competence).')</p>';
            }
        } else {
            echo '<p>Компетенции не найдены в БД</p>';
        } //закрытие соеденения с БД
        $conn->close();
        ?>
    </div>
</div>

            <div class="Block3" id="about-method"> <!--3-й блок-->
                <div class="Text1Block3">
                    <p class="TextInText1InBlock3">Наши занятия подойдут вам если:</p>
                </div>
                <div class="TableBorderGradient">
                <div class="Table1Block3">
                   <div class="PointAndText"> <!--первая строка таблицы-->
                    <div class="Point"></div>
                    <div class="TableTextBlock3">
                        <p class="TableTextInBlock3">если вы хотите учить язык в<br>комфортном темпе</p>
                    </div></div> 
                    <div class="TableLine"></div>
                    <div class="PointAndText"> <!--вторая строка таблицы-->
                        <div class="Point"></div>
                        <div class="TableTextBlock3">
                            <p class="TableTextInBlock3">если вам важно видеть прогресс</p>
                        </div></div> 
                        <div class="TableLine"></div>
                        <div class="PointAndText"> <!--третья строка таблицы-->
                            <div class="Point"></div>
                            <div class="TableTextBlock3">
                                <p class="TableTextInBlock3">если вы цените практические<br>занятия</p>
                            </div></div> 
                            <div class="TableLine"></div>
                            <div class="PointAndText"> <!--четвертая строка таблицы-->
                                <div class="Point"></div>
                                <div class="TableTextBlock3">
                                    <p class="TableTextInBlock3">если вам важен индивидуальный<br>подход</p>
                                </div></div> 
                                <div class="TableLine"></div>
                                <div class="PointAndText"> <!--пятая строка таблицы-->
                                    <div class="Point"></div>
                                    <div class="TableTextBlock3">
                                        <p class="TableTextInBlock3">если вы хотите учить язык с нуля</p>
                                    </div></div> 
                                    <div class="TableLine"></div>
                                    <div class="PointAndText"> <!--шестая строка таблицы-->
                                        <div class="Point"></div>
                                        <div class="TableTextBlock3">
                                            <p class="TableTextInBlock3">если вы хотите учить язык с<br>удовольствием</p>
                                        </div></div> 
                                        <div class="TableLine"></div>
            </div></div>
            </div>
    
            <div class="Block4"><!--4-й блок-->
                <div class="Text1Block4">
                    <p class="TextInBlock4">Начните обучение с нами, прямо сейчас!</p>
                </div>
                <div class="Text2Block4">
                    <p class="TextInBlock4">Запишитесь на бесплатную консультацию:</p>
                </div>
                <div class="MarkAndText"> <!--первая ячейка-->
                <div class="MarkGradient"><div class="Mark"><p class="MarkNumber">1</p></div></div>
                <div class="TextUnderMarkGradient"><div class="TextUnderMark">
                <p class="TextInTextUnderMark">наш методист определит ваш уровень знаний и составит индиидуальный план занятий</p>
                </div></div></div>
                        <div class="MarkAndText"> <!--вторая ячейка-->
                        <div class="MarkGradient"><div class="Mark"><p class="MarkNumber">2</p></div></div>
                        <div class="TextUnderMarkGradient"><div class="TextUnderMark">
                        <p class="TextInTextUnderMark">вы определите время в которое вам было бы удобно заниматься </p>
                        </div></div></div>
                            <div class="MarkAndText"> <!--третья ячейка-->
                            <div class="MarkGradient"><div class="Mark"><p class="MarkNumber">3</p></div></div>
                            <div class="TextUnderMarkGradient"><div class="TextUnderMark">
                                <p class="TextInTextUnderMark">наш педагогог будет ждать вас на первом занятии</p>
                            </div></div></div>
            </div>


            <div class="Block5" id="ConsultReg"> <!--5-й блок-->
            <div class="ImageBlock5"></div>
            <div class="FormBlock5">
                <div class="success-message">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="#4CAF50">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    <p>Отправлено!</p>
            </div>
            <div class="FieldBlock">
                <div class="InputField"><!--1-е поле ввода-->
                <input type="text" placeholder="ФИО" class="glowing-input">
                </div>
                        <div class="InputField"><!--2-е поле ввода-->
                        <input type="email" placeholder="E-mail" class="glowing-input"> 
                        </div>
                            <div class="InputField"><!--3-е поле ввода-->
                            <input type="tel" placeholder="Номер телефона" class="glowing-input"> 
                            </div>
                        </div> 
            <button class="RegOnConsultationButton2">Записаться на консультацию</button>
            </div>
        </div>
        
        <div class="CommentBlock" id="reviews">
            
    <?php  
    // Подключаю скрипт для соединения с БД
    include 'PHPscripts/connect.php';  

    // Получаю комментарии из БД
    $sql = "SELECT Commentator_Name, Text FROM comments ORDER BY ID";
    $result = $conn->query($sql);

    // Проверяю, есть ли результаты запроса
    if ($result->num_rows > 0) {
        // Создаю массив для хранения комментариев
        $comments = array();
        
        // Преобразую результат запроса в ассоциативный массив
        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        
        // Для десктопной версии разбиваю комментарии по 3 штуки
        $desktopGroups = array_chunk($comments, 3);
        // Для мобильной версии оставляю все комментарии по 1-й штуке
        $mobileComments = $comments;
    ?>
    
    <!-- Блок карусели для десктопной версии -->
    <div class="desktop-carousel d-none d-md-block">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php foreach($desktopGroups as $index => $group): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="ForComment">
                            <?php foreach($group as $comment): ?>
                                <div class="comment">
                                    <!-- Имя комментатора -->
                                    <p class="CAbzach"><?= htmlspecialchars($comment['Commentator_Name']) ?></p>
                                    <!-- Текст комментария -->
                                    <p class="Ctext"><?= htmlspecialchars($comment['Text']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Кнопка "Назад" для карусели -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <!-- Кнопка "Вперед" для карусели -->
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
    <!-- Блок карусели для мобильной версии -->
    <div class="mobile-carousel d-block d-md-none">
        <!-- Автоматическая карусель без управления -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($mobileComments as $index => $comment): ?>
                    <!-- Каждый комментарий - отдельный слайд -->
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="comment">
                            <!-- Имя комментатора -->
                            <p class="CAbzach"><?= htmlspecialchars($comment['Commentator_Name']) ?></p>
                            <!-- Текст комментария -->
                            <p class="Ctext"><?= htmlspecialchars($comment['Text']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <?php
    } else {
        // Если комментариев нет, вывожу сообщение
        echo "<p>Пока комментариев нет</p>";
    }
    
    // Закрываю соединение с БД
    $conn->close();
    ?>
</div>

      <?php  include 'PHPscripts/connect.php';  //подключение к БД

    // Получение данных из БД
    $sql = "SELECT Phone_Number, Email, Telegram FROM communications LIMIT 1";
    $result = $conn->query($sql);

//проверяю есть ли результаты поиска
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $phone = $row["Phone_Number"];
    $email = $row["Email"];
    $telegram = $row["Telegram"];

    $conn->close();
?>

<div class="Footer">
    <p class="AllRights">© 2025 DeutschProfi. Все права защищены.</p> 
    <div class="Communications">
        <a href="<?php echo htmlspecialchars($telegram); ?>" target="_blank"> <!-- Получение данных для коммуникации, Телеграм -->
        <img src="img/tg.svg" alt="" class="Tg"></a>
        <a href="tel:+<?php echo htmlspecialchars($phone); ?>">  <!-- Получение данных для коммуникации, Телефон -->
        <img src="img/Phone.svg" alt="" class="Phone"></a>
        <a href="https://e.mail.ru/compose/?to=<?php echo htmlspecialchars($email); ?>&subject=Вопрос%20по%20сайту&body=Здравствуйте%2C%20у%20меня%20вопрос%3A" target="_blank"><!-- Получение данных для коммуникации, Почта (основано на "url кодировании") -->
        <img src="img/email.svg" alt="" class="Email"></a>
    </div>
</div>

<?php
} else {
    $conn->close(); //закрытие соединения
    die("Ошибка: контактные данные не найдены в базе.");
}
?>
    </div>
    </div>
<script src="javascript/reload.js"></script>
<script src="javascript/burger.js"></script>
<script src="javascript/RegOnConsultation.js"></script>
</html>     