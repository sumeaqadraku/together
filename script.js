let currentIndex = 0; // Current starting index
const slidesToShow = 4; // Number of slides to show at a time
const slideWidth = 100 / slidesToShow; // Width of each slide
const slides = document.querySelectorAll('.slide');
const carousel = document.querySelector('.carousel');

// Set up initial widths dynamically
document.addEventListener('DOMContentLoaded', () => {
    slides.forEach(slide => {
        slide.style.flex = `0 0 ${slideWidth}%`;
    });
});

function changeSlide(direction) {
    const totalSlides = slides.length;
    const maxIndex = totalSlides - slidesToShow;

    currentIndex += direction;
    if (currentIndex < 0) {
        currentIndex = maxIndex;
    } else if (currentIndex > maxIndex) {
        currentIndex = 0;
    }

    const translateX = -currentIndex * slideWidth * slidesToShow;
    carousel.style.transform = `translateX(${translateX}%)`;
}
