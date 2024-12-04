let currentSlide = 0;

function changeSlide(direction) {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    const visibleSlides = 4;

    currentSlide += direction;

    if (currentSlide < 0) {
        currentSlide = totalSlides - visibleSlides;
    } else if (currentSlide > totalSlides - visibleSlides) {
        currentSlide = 0;
    }

    const translateX = -currentSlide * (100 / visibleSlides);
    carousel.style.transform = `translateX(${translateX}%)`;
}
