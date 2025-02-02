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
    errorMessages.innerHTML = "";

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

    if (isValid) {
      alert("The form is valid!");
      form.submit();
    }
  };

  form.addEventListener("submit", validateForm);
});
