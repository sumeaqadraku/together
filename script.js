// Navigate to a different page
function navigateTo(page) {
    window.location.href = page;
  }
  
  // Handle form submission (Contact Page)
  document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contactForm");
  
    if (contactForm) {
      contactForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const message = document.getElementById("message").value;
  
        alert(`Thank you, ${name}! We have received your message.`);
        contactForm.reset();
      });
    }
  });
  