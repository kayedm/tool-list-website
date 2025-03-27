
document.addEventListener("DOMContentLoaded", () => {

    //Tests if the DOM has loaded
    console.log("DOM loaded");

    //Gets the login form and signup form
    const loginform = document.getElementById("loginform");
    const signupform = document.getElementById("signupform");

    //Gets the login form fields
    const loginEmail = loginform.querySelector('[name="email"]');
    const loginPass = loginform.querySelector('[name="password"]');

    //Gets the signup form fields
    const signupName = document.querySelector("#signup-name");
    const signupEmail = document.querySelector("#signup-email");
    const signupPass = document.querySelector("#signup-password");
    const signupPass2 = document.querySelector("#signup-password2");


    //Displays error message
    const showError = (element, message) => {
        const field = element.parentElement;
        const errorBox = field.querySelector(".error");
        errorBox.innerText = message;
    };

    //Clears error message
    const showSuccess = (element) => {
        const field = element.parentElement;
        const errorBox = field.querySelector(".error");
        errorBox.innerText = "";
    };


    //Validates the email
    function validateEmail(element) {
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(element.value)) {
            showError(element, "Please enter a valid email address with the format xyz@xyz.xyz");
            return false;
        } else {
            showSuccess(element);
            return true;
        }
    }
    

    //Validates the passwords
    function validatePassword(element) {
        if (element.value.length < 8 || !/\d/.test(element.value)) {
            showError(element, "Password must be at least 8 characters and contain a number.");
            return false;
        } else {
            showSuccess(element);
            return true;
        }
    }
    

    //Checks if the passwords match
    function validatePasswordMatch() {
        const password = document.querySelector("#signup-password");
        const confirmPassword = document.querySelector("#signup-password2");
        
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Passwords do not match.");
            return false;
        } else {
            showSuccess(confirmPassword);
            return true;
        }
    }
    

    //Checks if fields are empty
    function validateNotEmpty(element, errorMessage) {
        if (element.value.trim() === "") {
            showError(element, errorMessage);
            return false; // Return false if the field is empty
        } else {
            showSuccess(element);
            return true; // Return true if the field is not empty
        }
    }
    

    //Attached event listeners for real-time validation for login form
    loginEmail.addEventListener("input", () => validateEmail(loginEmail));
    loginPass.addEventListener("input", () => validatePassword(loginPass));


    //Stops login form submition if validation fails
    loginform.addEventListener("submit", function (e) {
        if (!validateEmail(loginEmail) || !validatePassword(loginPass)) {
            e.preventDefault();
        }
    });

    //Stops signup form submition if validation fails
    signupform.addEventListener("submit", function (e) {
        let isValid = true;

        if (!validateNotEmpty(signupName, "Name cannot be empty.")) isValid = false;
        if (!validateEmail(signupEmail)) isValid = false;
        if (!validatePassword(signupPass)) isValid = false;
        if (!validatePasswordMatch()) isValid = false;

        if (!isValid) {
            e.preventDefault();
        }
    });

    //Attached event listeners for real-time validatiopn for signup forms
    signupName.addEventListener("input", () => validateNotEmpty(signupName, "Name cannot be empty"));
    signupEmail.addEventListener("input", () => validateEmail(signupEmail));
    signupPass.addEventListener("input", () => validatePassword(signupPass));
    signupPass2.addEventListener("input", validatePasswordMatch);
});

// Toggles dark mode on and off
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
}
