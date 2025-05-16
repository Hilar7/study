// Ожидаем полной загрузки DOM (структуры HTML-документа) перед выполнением скрипта
document.addEventListener('DOMContentLoaded', function() {
    // Получаем элементы со страницы:
    // - Кнопку отправки формы
    const submitButton = document.querySelector('.RegOnConsultationButton2');
    // - Сообщение об успешной отправке
    const successMessage = document.querySelector('.success-message');
    // - Все поля ввода в форме
    const inputFields = document.querySelectorAll('.InputField input');

    // Функция для разделения строки с ФИО на отдельные компоненты (фамилия, имя, отчество)
    function splitFullName(fullName) {
        // Удаляем лишние пробелы и разделяем по пробелам
        const parts = fullName.trim().split(/\s+/);
        return {
            lastName: parts[0] || '',    // Фамилия (первая часть)
            firstName: parts[1] || '',   // Имя (вторая часть)
            middleName: parts[2] || ''   // Отчество (третья часть, если есть)
        };
    }

    // Для каждого поля ввода добавляем иконку ошибки и обработчики событий
    inputFields.forEach(input => {
        // Создаем элемент иконки ошибки (красный крестик)
        const errorIcon = document.createElement('span');
        errorIcon.className = 'error-icon';
        errorIcon.innerHTML = '❌';
        errorIcon.style.display = 'none'; // Изначально скрыта
        // Позиционируем иконку справа внутри поля ввода
        errorIcon.style.position = 'absolute';
        errorIcon.style.right = '15px';
        errorIcon.style.top = '50%';
        errorIcon.style.transform = 'translateY(-50%)';
        errorIcon.style.color = 'red';
        errorIcon.style.fontSize = '20px';
        errorIcon.style.pointerEvents = 'none'; // Чтобы не мешала вводу
        
        // Устанавливаем относительное позиционирование для родительского элемента
        input.parentElement.style.position = 'relative';
        // Добавляем иконку ошибки в DOM
        input.parentElement.appendChild(errorIcon);
        
        // Обработчик ввода данных - сбрасываем стили ошибки при начале ввода
        input.addEventListener('input', function() {
            this.style.borderColor = '#cfcfcf'; // Возвращаем стандартный цвет рамки
            this.nextElementSibling.style.display = 'none'; // Скрываем иконку ошибки
        });
    });
    
    // Обработчик клика по кнопке отправки формы
    submitButton.addEventListener('click', function(e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы (перезагрузку страницы)
        let allFilled = true; // Флаг для проверки заполненности всех полей
        
        // Проверяем каждое поле на заполненность
        inputFields.forEach(input => {
            if (!input.value.trim()) { // Если поле пустое или содержит только пробелы
                allFilled = false;
                input.style.borderColor = 'red'; // Подсвечиваем поле красным
                input.nextElementSibling.style.display = 'block'; // Показываем иконку ошибки
                
                // Добавляем анимацию "тряски" для пустого поля
                input.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    input.style.animation = ''; // Убираем анимацию через 0.5 секунды
                }, 500);
            }
        });
        
        // Если не все поля заполнены
        if (!allFilled) {
            // Добавляем анимацию "тряски" для кнопки
            this.style.animation = 'shake 0.5s';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
            return; // Прекращаем выполнение функции
        }
        
        // Если все поля заполнены, получаем значения:
        const fullName = document.querySelector('input[placeholder="ФИО"]').value;
        const email = document.querySelector('input[placeholder="E-mail"]').value;
        const phone = document.querySelector('input[placeholder="Номер телефона"]').value;
        
        // Разделяем ФИО на компоненты
        const nameParts = splitFullName(fullName);
        
        // Формируем объект с данными для отправки
        const formData = {
            lastName: nameParts.lastName,
            firstName: nameParts.firstName,
            middleName: nameParts.middleName,
            email: email,
            phone: phone
        };
        
        // Логируем данные в консоль (для отладки)
        console.log("Отправляемые данные:", formData);
        
        // Отправляем данные на сервер с помощью Fetch API
        fetch('save_consultation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Указываем тип содержимого
            },
            body: JSON.stringify(formData) // Преобразуем объект в JSON-строку
        })
        .then(response => response.json()) // Парсим JSON-ответ от сервера
        .then(data => {
            if (data.success) {
                // Если успешно, очищаем поля формы
                inputFields.forEach(input => {
                    input.value = '';
                });
                
                // Показываем сообщение об успехе
                successMessage.classList.add('show');
                
                // Скрываем сообщение через 3 секунды
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
            } else {
                // Если ошибка, показываем сообщение
                alert('Ошибка при сохранении данных: ' + (data.error || 'Неизвестная ошибка'));
            }
        })
        .catch(error => {
            // Обрабатываем ошибки сети или сервера
            console.error('Error:', error);
            alert('Произошла ошибка при отправке данных');
        });
    });
    
    // Создаем и добавляем стиль для анимации "тряски"
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