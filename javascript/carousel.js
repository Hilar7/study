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