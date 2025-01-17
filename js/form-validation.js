document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("password");
    const errorMessages = document.createElement("div");
    
    errorMessages.id = "error-messages";
    errorMessages.style.color = "red";
    errorMessages.style.marginTop = "10px";
    form.appendChild(errorMessages);
  
    const emailValid = (email) => {
      const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
      return emailRegex.test(email.toLowerCase());
    };
  
    const validateForm = (event) => {
      event.preventDefault();
      errorMessages.innerHTML = "";
  
      const emailValue = emailField.value.trim();
      const passwordValue = passwordField.value.trim();
      let isValid = true;
  
      if (emailValue === "") {
        errorMessages.innerHTML += "<p>Ju lutem shtoni email-in.</p>";
        emailField.focus();
        isValid = false;
      } else if (!emailValid(emailValue)) {
        errorMessages.innerHTML += "<p>Ju lutem shtoni një email të vlefshëm.</p>";
        emailField.focus();
        isValid = false;
      }
  
      if (passwordValue === "") {
        errorMessages.innerHTML += "<p>Ju lutem shtoni fjalëkalimin.</p>";
        if (isValid) passwordField.focus();
        isValid = false;
      } else if (passwordValue.length < 6) {
        errorMessages.innerHTML += "<p>Fjalëkalimi duhet të ketë të paktën 6 karaktere.</p>";
        if (isValid) passwordField.focus();
        isValid = false;
      }
  
      if (isValid) {
        alert("Forma është valide!");
        form.submit();
      }
    };
  
    form.addEventListener("submit", validateForm);
  });
  