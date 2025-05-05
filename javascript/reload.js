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
