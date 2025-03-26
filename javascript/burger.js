document.addEventListener('DOMContentLoaded', function() {
    const burgerNavLinks = document.querySelectorAll('.burger-nav a');
    const burgerToggle = document.getElementById('burger-toggle');
    const burgerMenu = document.querySelector('.mobile-menu .menu');
    const burgerNav = document.querySelector('.burger-nav');
    
    burgerToggle.addEventListener('change', function() {
        if (!this.checked) {
            burgerMenu.classList.add('closed');
            burgerNav.classList.add('closed');
        } else {
            burgerMenu.classList.remove('closed');
            burgerNav.classList.remove('closed');
        }
    });
    
    burgerNavLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            burgerToggle.checked = false;
            burgerToggle.dispatchEvent(new Event('change'));
            
            const targetId = this.getAttribute('href');
            if (targetId.startsWith('#')) {
                e.preventDefault();
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});