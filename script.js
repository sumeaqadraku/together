let currentSlide = 0;

function changeSlide(direction) {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    const visibleSlides = 4; // Number of slides visible at a time

    currentSlide += direction;

    if (currentSlide < 0) {
        currentSlide = totalSlides - visibleSlides; // Wrap to the last slide
    } else if (currentSlide > totalSlides - visibleSlides) {
        currentSlide = 0; // Wrap to the first slide
    }

    const translateX = -currentSlide * (100 / visibleSlides);
    carousel.style.transform = `translateX(${translateX}%)`;
}

// Set up the automatic slide transition (every 2 seconds for forward direction)
setInterval(() => changeSlide(1), 1000); // Change slide every 2 seconds (direction: 1 means forward)



// Function to create the cursor trail
document.addEventListener('mousemove', function(event) {
    const cursorTrail = document.createElement('div');
    cursorTrail.classList.add('cursor-trail');
    document.body.appendChild(cursorTrail);
  
    // Position the trail at the current cursor position
    cursorTrail.style.left = `${event.pageX - 7.5}px`;  // Center the circle at the cursor
    cursorTrail.style.top = `${event.pageY - 7.5}px`;
  
    // Remove the trail after the animation completes (1s)
    setTimeout(() => {
      cursorTrail.remove();
    }, 1000);
  });
  



// Add scrolling effect for navbar
document.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
  
  // Fade-in effect for sections
  const sections = document.querySelectorAll(".fade-in");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    { threshold: 0.2 } // Trigger when 20% of the section is visible
  );
  
  sections.forEach((section) => observer.observe(section));
  