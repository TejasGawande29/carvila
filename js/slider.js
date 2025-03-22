const slider = {
    index: 0,
    slides: document.querySelector('.slides'),
    dotsContainer: document.querySelector('.dots'),
    slidesCount: document.querySelectorAll('.slide').length,
    interval: null,

    init() {
        // Create dots
        this.createDots();
        
        // Event listeners
        document.querySelector('.prev').addEventListener('click', () => this.move(-1));
        document.querySelector('.next').addEventListener('click', () => this.move(1));
        this.dotsContainer.addEventListener('click', e => {
            if (e.target.classList.contains('dot')) {
                const index = [...e.target.parentNode.children].indexOf(e.target);
                this.jumpTo(index);
            }
        });

        // Auto-play
        this.startAutoPlay();
        
        // Initial position
        this.update();
    },

    createDots() {
        this.dotsContainer.innerHTML = Array(this.slidesCount)
            .fill()
            .map((_, i) => `<div class="dot ${i === 0 ? 'active' : ''}" aria-label="Slide ${i + 1}"></div>`)
            .join('');
    },

    move(step) {
        this.index += step;
        this.update();
    },

    jumpTo(index) {
        this.index = index;
        this.update();
        this.resetAutoPlay();
    },

    update() {
        // Handle infinite loop
        this.index = (this.index + this.slidesCount) % this.slidesCount;
        
        // Update slides position
        this.slides.style.transform = `translateX(-${this.index * 100}%)`;
        
        // Update dots
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        this.dotsContainer.children[this.index].classList.add('active');
    },

    startAutoPlay() {
        this.interval = setInterval(() => this.move(1), 5000);
    },

    resetAutoPlay() {
        clearInterval(this.interval);
        this.startAutoPlay();
    }
};

// Initialize slider
slider.init();

// Optional: Add touch support
let touchStartX = 0;
const sliderContainer = document.querySelector('.slider-container');

sliderContainer.addEventListener('touchstart', e => {
    touchStartX = e.touches[0].clientX;
});

sliderContainer.addEventListener('touchend', e => {
    const touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > 50) {
        slider.move(diff > 0 ? 1 : -1);
    }
});