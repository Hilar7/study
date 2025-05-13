
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.querySelector('.AuthorizationButton');
    const successMessage = document.querySelector('.success-message');
    const inputFields = document.querySelectorAll('.InputField input');
    

    inputFields.forEach(input => {
        const errorIcon = document.createElement('span');
        errorIcon.className = 'error-icon';
        errorIcon.innerHTML = '❌';
        errorIcon.style.display = 'none';
        errorIcon.style.position = 'absolute';
        errorIcon.style.right = '15px';
        errorIcon.style.top = '50%';
        errorIcon.style.transform = 'translateY(-50%)';
        errorIcon.style.color = 'red';
        errorIcon.style.fontSize = '20px';
        errorIcon.style.pointerEvents = 'none';
        
        input.parentElement.style.position = 'relative';
        input.parentElement.appendChild(errorIcon);
        
        // Сбрасываем ошибку при вводе
        input.addEventListener('input', function() {
            this.style.borderColor = '#cfcfcf';
            this.nextElementSibling.style.display = 'none';
        });
    });
    
    submitButton.addEventListener('click', function(e) {
        e.preventDefault();
        let allFilled = true;
        
        // Проверяем каждое поле
        inputFields.forEach(input => {
            if (!input.value.trim()) {
                allFilled = false;
                input.style.borderColor = 'red';
                input.nextElementSibling.style.display = 'block';
                
                // Анимация "тряски" для пустого поля
                input.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    input.style.animation = '';
                }, 500);
            }
        });
        
        if (!allFilled) {
            // Анимация для кнопки при ошибке
            this.style.animation = 'shake 0.5s';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
            return;
        }
        
        // Если все поля заполнены
        inputFields.forEach(input => {
            input.value = '';
        });
        
        // Показываем сообщение об успехе
        successMessage.classList.add('show');
        
        // Скрываем сообщение через 3 секунды
        setTimeout(function() {
            successMessage.classList.remove('show');
        }, 3000);
    });
    
    // Добавляем стиль для анимации тряски
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
document.addEventListener('DOMContentLoaded', function() {
    const regButton1 = document.querySelector('.RegOnConsultationButton1');
    
    if (regButton1) {
        regButton1.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetBlock = document.getElementById('online-registration');
            if (targetBlock) {
                // Плавный скролл с учетом возможного фиксированного header'а
                const headerHeight = document.querySelector('.Header')?.offsetHeight || 0;
                const targetPosition = targetBlock.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Добавляем анимацию "пульсации" для кнопки
                this.style.animation = 'pulse 0.5s';
                setTimeout(() => {
                    this.style.animation = '';
                }, 500);
            }
        });
    }
    
    // Добавляем стиль для анимации пульсации
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(0.95); }
            100% { transform: scale(1); }
        }
        
        /* Гарантируем, что скролл будет плавным */
        html {
            scroll-behavior: smooth;
        }
    `;
    document.head.appendChild(style);
});