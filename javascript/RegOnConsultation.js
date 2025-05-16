// Ожидаем полной загрузки DOM перед выполнением скрипта
document.addEventListener('DOMContentLoaded', function() {
    // Получаем элементы со страницы:
    // Кнопка отправки формы
    const submitButton = document.querySelector('.RegOnConsultationButton2');
    // Сообщение об успешной отправке
    const successMessage = document.querySelector('.success-message');
    // Поля ввода в форме
    const inputFields = document.querySelectorAll('.InputField input');

    // Функция для разделения строки с ФИО на отдельные компоненты (фамилия, имя, отчество)
    function splitFullName(fullName) {
        // Удаляю лишние пробелы и разделяем по пробелам
        const parts = fullName.trim().split(/\s+/);
        return {
            lastName: parts[0] || '',    // Фамилия (первая часть)
            firstName: parts[1] || '',   // Имя (вторая часть)
            middleName: parts[2] || ''   // Отчество (третья часть)
        };
    }

    // Для каждого поля ввода добавляю иконку ошибки и обработчики событий
    inputFields.forEach(input => {
        // Создаю элемент иконки ошибки
        const errorIcon = document.createElement('span');
        errorIcon.className = 'error-icon';
        errorIcon.innerHTML = '❌';
        errorIcon.style.display = 'none'; // Изначально скрыта
        // Позиционирую иконку справа внутри поля ввода
        errorIcon.style.position = 'absolute';
        errorIcon.style.right = '15px';
        errorIcon.style.top = '50%';
        errorIcon.style.transform = 'translateY(-50%)';
        errorIcon.style.color = 'red';
        errorIcon.style.fontSize = '20px';
        errorIcon.style.pointerEvents = 'none';

        // Устанавливаю относительное позиционирование для родительского элемента (relative)
        input.parentElement.style.position = 'relative';
        input.parentElement.appendChild(errorIcon);
        
        // Обработчик ввода данных - сбрасываю иконку ошибки при начале ввода
        input.addEventListener('input', function() {
            this.style.borderColor = '#cfcfcf'; // Возвращаю стандартный цвет рамки
            this.nextElementSibling.style.display = 'none'; // Скрываю иконку ошибки
        });
    });
    
    // Событие по клику по кнопке отправки формы
    submitButton.addEventListener('click', function(e) {
        e.preventDefault(); // Предотвращаю стандартное поведение формы
        let allFilled = true; // Флаг для проверки заполненности всех полей
        
        // Проверяю каждое поле на заполненность
        inputFields.forEach(input => {
            if (!input.value.trim()) { // Если поле пустое или содержит только пробелы
                allFilled = false;
                input.style.borderColor = 'red'; // Подсвечиваю поле красным
                input.nextElementSibling.style.display = 'block'; // Показываю иконку ошибки
                
                // Добавляю анимацию "тряски" для пустого поля
                input.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    input.style.animation = ''; // Убираю анимацию через 0.5 секунды
                }, 500);
            }
        });
        
        // Если не все поля заполнены
        if (!allFilled) {
            // Добавляю анимацию "тряски" для кнопки
            this.style.animation = 'shake 0.5s';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
            return; // Прекращаю выполнение функции
        }
        
        // Если все поля заполнены, получаю значения:
        const fullName = document.querySelector('input[placeholder="ФИО"]').value;
        const email = document.querySelector('input[placeholder="E-mail"]').value;
        const phone = document.querySelector('input[placeholder="Номер телефона"]').value;
        
        // Разделяю ФИО на компоненты
        const nameParts = splitFullName(fullName);
        
        // Формирую объект с данными для отправки
        const formData = {
            lastName: nameParts.lastName,
            firstName: nameParts.firstName,
            middleName: nameParts.middleName,
            email: email,
            phone: phone
        };
        
        // Логирую данные в консоль
        console.log("Отправляемые данные:", formData);
        
        // Отправляю данные на сервер с помощью Fetch
        fetch('../PHPscripts/save_consultation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Указываю тип содержимого
            },
            body: JSON.stringify(formData) // Преобразую объект в JSON
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Если успешно, очищаю поля формы
                inputFields.forEach(input => {
                    input.value = '';
                });
                
                // Показываю сообщение об успехе
                successMessage.classList.add('show');
                
                // Скрываю сообщение через 3 секунды
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
            } else {
                // Если ошибка, показываем сообщение
                alert('Ошибка при сохранении данных: ' + (data.error || 'Неизвестная ошибка'));
            }
        })
        .catch(error => {
            // Обрабатываю ошибки сети или сервера
            console.error('Error:', error);
            alert('Произошла ошибка при отправке данных');
        });
    });
    
    // Создаю и добавляю стиль для анимации "тряски"
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);
});