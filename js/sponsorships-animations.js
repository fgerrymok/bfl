// Intersection Observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const delay = parseInt(entry.target.dataset.delay) || 0;
            setTimeout(() => {
                entry.target.classList.add('animated');
                
                // Trigger specific animations
                if (entry.target.classList.contains('stats-grid')) {
                    animateStats();
                }

                if (entry.target.classList.contains('social-stats')) {
                    animateCounters();
                }
                
                if (entry.target.classList.contains('engagement-section')) {
                    animateEngagement();
                }
            }, delay);
            
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all elements with animation class
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    animatedElements.forEach(el => observer.observe(el));
});

// Animate statistics circles and bars
function animateStats() {
    // Animate circular stats
    const circles = document.querySelectorAll('.stat-circle');
    circles.forEach((circle, index) => {
        const percent = parseInt(circle.dataset.percent) || 0;
        setTimeout(() => {
            circle.style.setProperty('--percent', `${percent}%`);
            circle.classList.add('animated');
        }, index * 200);
    });
    
    // Animate bar stats
    const bars = document.querySelectorAll('.bar-fill');
    bars.forEach((bar, index) => {
        const width = parseInt(bar.dataset.width) || 0;
        setTimeout(() => {
            bar.style.width = `${width}%`;
        }, (circles.length + index) * 200);
    });
}

// Animate counters
function animateCounters() {
    const counters = document.querySelectorAll('.counter-number, .counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.target);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            if (target >= 1000000) {
                counter.textContent = (current / 1000000).toFixed(1) + 'M';
            } else if (target >= 1000) {
                counter.textContent = Math.floor(current).toLocaleString();
            } else {
                counter.textContent = Math.floor(current);
            }
        }, 16);
    });
}

// Animate engagement breakdown
function animateEngagement() {
    // Simple fade-in for engagement items
    const breakdownItems = document.querySelectorAll('.breakdown-item');
    breakdownItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
}
