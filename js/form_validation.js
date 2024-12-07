// Select the form and its elements
const loginForm = document.getElementById("loginForm");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");

loginForm.addEventListener("submit", (event) => {
  let isValid = true; // Assume the form is valid

  // Validate email
  if (!validateEmail(emailInput.value)) {
    alert("Please enter a valid email address!");
    isValid = false;
  }

  // Validate password (minimum length of 6 characters)
  if (passwordInput.value.length < 6) {
    alert("Password must be at least 6 characters long!");
    isValid = false;
  }

  // If the form is invalid, prevent submission
  if (!isValid) {
    event.preventDefault();
  }
});

// Function to validate email format
function validateEmail(email) {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(email);
}
