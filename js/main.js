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


setInterval(() => changeSlide(1), 3000);


document.addEventListener('mousemove', function(event) {
    const cursorTrail = document.createElement('div');
    cursorTrail.classList.add('cursor-trail');
    document.body.appendChild(cursorTrail);
  
    cursorTrail.style.left = `${event.pageX - 7.5}px`;  
    cursorTrail.style.top = `${event.pageY - 7.5}px`;
  
   
    setTimeout(() => {
      cursorTrail.remove();
    }, 1000);
  });
  



document.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
  
  const sections = document.querySelectorAll(".fade-in");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    { threshold: 0.2 } 
  );
  
  sections.forEach((section) => observer.observe(section));
  
