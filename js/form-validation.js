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

  const passwordValid = (password) => {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
  };

  const validateForm = (event) => {
    event.preventDefault();
    errorMessages.innerHTML = "";  // Çdo herë që forma dërgohet, pastro mesazhet e gabimit

    const emailValue = emailField.value.trim();
    const passwordValue = passwordField.value.trim();
    let isValid = true;

    if (emailValue === "") {
      errorMessages.innerHTML += "<p>Please enter your email.</p>";
      emailField.focus();
      isValid = false;
    } else if (!emailValid(emailValue)) {
      errorMessages.innerHTML += "<p>Please enter a valid email address.</p>";
      emailField.focus();
      isValid = false;
    }

    if (passwordValue === "") {
      errorMessages.innerHTML += "<p>Please enter your password.</p>";
      if (isValid) passwordField.focus();
      isValid = false;
    } else if (!passwordValid(passwordValue)) {
      errorMessages.innerHTML += "<p>Your password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.</p>";
      if (isValid) passwordField.focus();
      isValid = false;
    }

    // Nëse formulari është valid, dërgoje atë përmes AJAX
    if (isValid) {
      const formData = new FormData(form);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("The form is valid!");
          window.location.href = data.redirect_url;  // Redirektoni në faqen përkatëse
        } else {
          errorMessages.innerHTML = `<p>${data.error}</p>`;  // Shfaq gabimin nga serveri
        }
      })
      .catch(error => {
        errorMessages.innerHTML = "<p>There was an error processing your request. Please try again.</p>";
      });
    }
  };

  form.addEventListener("submit", validateForm);
});
