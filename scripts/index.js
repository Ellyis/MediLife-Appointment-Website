function show_error(input_box, error_column, error_message ,input_column, input_margin_bottom, div_height) {
  document.getElementById(error_column).innerHTML = "<img src='images/error.png' style='width: 20px; position: relative; top:3px;'>" + error_message;
  document.getElementById(input_column).style.border = "2px solid red";
  document.getElementById(input_box).style.marginBottom = `${parseFloat(input_margin_bottom) - parseFloat(div_height) - 2}px`;
  document.getElementById(input_column).focus();
  return false
}

function remove_error(input_box, error_column, input_column) {
  document.getElementById(error_column).innerHTML = "";
  document.getElementById(input_column).style.border = "1px solid black";
  document.getElementById(input_box).style.marginBottom = "";
  return true
}

// validate login  

function validate_login_email() {
  var email = document.getElementById("login-email").value;
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false) {
    return show_error("login-email-box", "email-error", "Enter a valid email!", "login-email", "40", "24");
  }
  return remove_error("login-email-box", "email-error", "login-email");
}


function validate_login_password() {
  var password = document.getElementById("login-password").value;
  if (password == "") {
    return show_error("login-password-box", "password-error", "Please enter password", "login-password", "40", "24");
  }
  return remove_error("login-password-box", "password-error", "login-password");
}

function validate_login() {
  var password = validate_login_password();
  var email = validate_login_email();
  if (email && password) {
    return true;
  }
  return false;
}

// validate signup

function validate_signup_email() {
  var email = document.getElementById("signup-email").value;
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false) {
    return show_error("signup-email-box", "email-error", "Enter a valid email!", "signup-email", "40", "24");
  }
  return remove_error("signup-email-box", "email-error", "signup-email");
}


function validate_signup_password(){
  var password = document.getElementById("signup-password").value;
  if (/^(?=.{8,30}$)/.test(password) == false) {
    return show_error("signup-password-box", "password-error", "Length must be between 8 and 30", "signup-password", "40", "24");
  }
  else if (/^[a-zA-Z]+/.test(password) == false) {
    return show_error("signup-password-box", "password-error", "First character must be alphabet", "signup-password", "40", "24");    
  }
  else if (/^[a-zA-Z0-9!@#$%^&*]+$/.test(password) == false) {
    return show_error("signup-password-box", "password-error", "Only alphanumeric and special characters are allowed", "signup-password", "40", "24");  
  }
  return remove_error("signup-password-box", "password-error", "signup-password")
}

function validate_signup_confirm_password() {
  var password = document.getElementById("signup-password").value;
  var confirm_password = document.getElementById("confirm-password").value;
  if (confirm_password == "") {
    return show_error("signup-confirm-password-box", "confirm-password-error", "Please enter password", "confirm-password", "40", "24");
  }
  else if (confirm_password != password) {
    return show_error("signup-confirm-password-box", "confirm-password-error", "Password does not match", "confirm-password", "40", "24");
  }
  return remove_error("signup-confirm-password-box", "confirm-password-error", "confirm-password");
}


function validate_signup() {
  var confirm_password = validate_signup_confirm_password();
  var password = validate_signup_password();
  var email = validate_signup_email();
  
  if ((email && password) && confirm_password) {
    return true;
  }
  return false;
}

