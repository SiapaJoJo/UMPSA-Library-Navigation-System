
document.addEventListener('DOMContentLoaded', function() {

    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {

            this.classList.add('loading');

            createRippleEffect(e, this);
        });
    });

    const buttons = document.querySelectorAll('button, .btn-smooth');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            createRippleEffect(e, this);
        });
    });

    const cards = document.querySelectorAll('.card-smooth, .bg-white\\/80');
    cards.forEach((card, index) => {
        card.classList.add('stagger-item');
        card.style.animationDelay = `${index * 0.1}s`;
    });

    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.classList.add('image-smooth');
    });

    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.classList.add('input-smooth');

        input.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-in');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-in');
        });
    });

    const pageContent = document.querySelector('.page-content');
    if (pageContent) {
        pageContent.classList.add('fade-in');
    }

    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.classList.add('loading', 'pulse-smooth');
                submitButton.disabled = true;

                setTimeout(() => {
                    submitButton.classList.remove('loading', 'pulse-smooth');
                    submitButton.disabled = false;
                }, 3000);
            }
        });
    });

    const modals = document.querySelectorAll('[x-data*="modal"]');
    modals.forEach(modal => {
        modal.addEventListener('show', function() {
            this.classList.add('scale-in');
        });
        
        modal.addEventListener('hide', function() {
            this.classList.remove('scale-in');
        });
    });

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.card-smooth, .bg-white\\/80, section, .stagger-item');
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    const dropdowns = document.querySelectorAll('[x-data*="open"]');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('show', function() {
            this.classList.add('scale-in');
        });
        
        dropdown.addEventListener('hide', function() {
            this.classList.remove('scale-in');
        });
    });

    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('[x-show="true"]');
            openModals.forEach(modal => {
                if (modal.dispatchEvent) {
                    modal.dispatchEvent(new CustomEvent('close'));
                }
            });
        }
    });

    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.classList.add('stagger-item');
        row.style.animationDelay = `${index * 0.05}s`;
    });

    const messages = document.querySelectorAll('.alert, .message, [role="alert"]');
    messages.forEach(message => {
        message.classList.add('fade-in');

        setTimeout(() => {
            message.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            message.style.opacity = '0';
            message.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                message.remove();
            }, 500);
        }, 5000);
    });
});

function createRippleEffect(event, element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

const rippleCSS = `
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
`;

const style = document.createElement('style');
style.textContent = rippleCSS;
document.head.appendChild(style);

window.addEventListener('beforeunload', function() {
    document.body.classList.add('page-exit');
});

document.addEventListener('alpine:init', () => {
    Alpine.directive('transition', (el, { expression }, { effect, cleanup }) => {
        const duration = 300;
        
        effect(() => {
            el.style.transition = `all ${duration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
        });
    });
});

function addSmoothTransitions() {
    const newElements = document.querySelectorAll('.new-content');
    newElements.forEach((element, index) => {
        element.classList.add('fade-in');
        element.style.animationDelay = `${index * 0.1}s`;
    });
}

window.smoothNavigation = {
    addSmoothTransitions,
    createRippleEffect
};
