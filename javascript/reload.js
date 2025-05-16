window.addEventListener('load', function() {
    // Минимальное время, которое должен отображаться load
    const minDisplayTime = 3000;
    
    // Получаю текущее время загрузки страницы
    const loadTime = performance.now();
    
    // Устанавливаю таймаут для скрытия load
    setTimeout(function() {
        // Плавно изменяю прозрачность load до 0
        document.querySelector('.loader').style.opacity = '0';
        
        // После завершения анимации прозрачности полностью скрываю load
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
        }, 500);
    }, 
    // Если страница загрузилась быстрее minDisplayTime, дожидаюсь оставшееся время
    // Если загрузка заняла больше minDisplayTime, скрываю load сразу 
    Math.max(0, minDisplayTime - loadTime));
});
