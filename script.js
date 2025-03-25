window.addEventListener('load', function() {
    const minDisplayTime = 3000;
    const loadTime = performance.now();
    
    setTimeout(function() {
        document.querySelector('.loader').style.opacity = '0';
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
        }, 500);
    }, Math.max(0, minDisplayTime - loadTime));
});

let startX = 0;
const commentCarousel = document.querySelector('#carouselExample');

commentCarousel.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

commentCarousel.addEventListener('touchend', (e) => {
    const endX = e.changedTouches[0].clientX;
    if (startX - endX > 50) {
        // Свайп влево - следующий слайд
        $('.carousel').carousel('next');
    }
    if (endX - startX > 50) {
        // Свайп вправо - предыдущий слайд
        $('.carousel').carousel('prev');
    }
});