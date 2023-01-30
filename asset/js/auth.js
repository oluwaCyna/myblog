//Login and Registeration
let registerForm = document.forms["register-form"];
let loginForm = document.forms["login-form"];

let formTitle = document.getElementById("modal-label");

let registerUsername = registerForm["register-username"];
let registerEmail = registerForm["register-email"];
let registerPassword = registerForm["register-password"];
let registerConfirmPassword = registerForm["register-confirm-password"];

let registerUsernameError = document.getElementById("register-username-error");
let registerEmailError = document.getElementById("register-email-error");
let registerPasswordError = document.getElementById("register-password-error");
let registerConfirmPasswordError = document.getElementById("register-confirm-password-error");

let loginEmail = loginForm["login-email"];
let loginPassword = loginForm["login-password"];

let loginEmailError = document.getElementById("login-email-error");
let loginPasswordError = document.getElementById("login-password-error");

let emailCheck = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|co|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/;
let userCheck = /^[a-z][a-z]+\d*$|^[a-z]\d\d+$/i;
let passwordCheck = /^[A-Za-z]\w{6,14}$/;

//Register
function checkRegisterRequired() {
  if (registerUsername.value.length == 0) {
    registerUsernameError.innerHTML = "required *";
  } else {
    registerUsernameError.innerHTML = "";
    validateRegisterUsername();
  }
  if (registerEmail.value.length == 0) {
    registerEmailError.innerHTML = "required *";
  } else {
    registerEmailError.innerHTML = "";
    validateRegisterEmail();
  }
  if (registerPassword.value.length == 0) {
    registerPasswordError.innerHTML = "required *";
  } else {
    registerPasswordError.innerHTML = "";
    validateRegisterPassword();
  }
  if (registerConfirmPassword.value.length == 0) {
    registerConfirmPasswordError.innerHTML = "required *";
  } else {
    registerConfirmPasswordError.innerHTML = "";
    validateConfirmPassword();
  }
}

function validateRegisterUsername() {
  if (userCheck.test(registerUsername.value.trim())) {
    registerUsernameError.innerHTML = "";
  } else {
    registerUsernameError.innerHTML =
      "Username can only be alphanumeric characters, Atleast 2 letters, and doesn't start with number.";
  }
}

function validateRegisterEmail() {
  if (emailCheck.test(registerEmail.value.trim().toLowerCase())) {
    registerEmailError.innerHTML = "";
  } else {
    registerEmailError.innerHTML = "Invalid email address!";
  }
}

function validateRegisterPassword() {
  if (passwordCheck.test(registerPassword.value.trim())) {
    registerPasswordError.innerHTML = "";
  } else {
    registerPasswordError.innerHTML =
      "Password must be 7-16 alphanumeric characters, underscore and first character must be a letter.";
  }
}

function validateConfirmPassword() {
  if (passwordCheck.test(registerConfirmPassword.value.trim())) {
    registerConfirmPasswordError.innerHTML = "";
    if (registerPassword.value !== registerConfirmPassword.value) {
      registerConfirmPasswordError.innerHTML = "Password did not match";
    } else {
      registerConfirmPasswordError.innerHTML = "";
    }
  } else {
    registerConfirmPasswordError.innerHTML =
      "Password must be 7-16 alphanumeric characters, underscore and first character must be a letter.";
  }
}

//Login
function checkLoginRequired() {
  if (loginEmail.value.length == 0) {
    loginEmailError.innerHTML = "required *";
  } else {
    loginEmailError.innerHTML = "";
    validateLoginEmail();
  }
  if (loginPassword.value.length == 0) {
    loginPasswordError.innerHTML = "required *";
  } else {
    loginPasswordError.innerHTML = "";
    validateLoginPassword();
  }
}

function validateLoginEmail() {
  if (emailCheck.test(loginEmail.value.trim().toLowerCase())) {
    loginEmailError.innerHTML = "";
  } else {
    loginEmailError.innerHTML = "Invalid email address!";
  }
}

function validateLoginPassword() {
  if (passwordCheck.test(loginPassword.value.trim())) {
    loginPasswordError.innerHTML = "";
  } else {
    loginPasswordError.innerHTML =
      "Password must be 7-16 alphanumeric characters, underscore and first character must be a letter.";
  }
}

//Hide login form on load
function hideForm() {
  loginForm.style.display = "none";
  formTitle.innerHTML = "Register";
}
hideForm();
// Show login form
function callLogin() {
  formTitle.innerHTML = "Login";
  loginForm.style.display = "block";
  registerForm.style.display = "none";
}

// Show Register form
function callRegister() {
  formTitle.innerHTML = "Register";
  loginForm.style.display = "none";
  registerForm.style.display = "block";
}

loginForm.onsubmit = function submitLoginForm(e) {
  e.preventDefault();
  checkLoginRequired();
  console.error(loginEmailError.innerText);
  if (!loginEmailError.innerText && !loginPasswordError.innerText) {
    console.error("Please enter a valid email address");
    loginForm.onsubmit = function (e) {
      return true;
    };
  }
};

registerForm.onsubmit = function submitRegisterForm(e) {
  e.preventDefault();
  checkRegisterRequired();
  if (
    !registerUsernameError.innerText &&
    !registerEmailError.innerText &&
    !registerPasswordError.innerText &&
    !registerConfirmPasswordError.innerText
  ) {
    registerForm.onsubmit = function (e) {
      return true;
    };
  }
};

//   Categories header
// document.getElementById('general').addEventListener('click', function (e) {
// $post_sql = "SELECT * FROM post WHERE category = 'General";
// $post_request = mysqli_query($db, $post_sql);})

// document.getElementById('politics').addEventListener('click', function (e) {
// $post_sql = "SELECT * FROM post WHERE category = 'Politics";
// $post_request = mysqli_query($db, $post_sql);})

// document.getElementById('sports').addEventListener('click', function (e) {
// $post_sql = "SELECT * FROM post WHERE category = 'Sports";
// $post_request = mysqli_query($db, $post_sql);})

// document.getElementById('music').addEventListener('click', function (e) {
// $post_sql = "SELECT * FROM post WHERE category = 'Music";
// $post_request = mysqli_query($db, $post_sql);})

