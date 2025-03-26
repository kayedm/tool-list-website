/* 
TODO:
1. actively listen for user input and clear error messages as the user corrects their input.
*/

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
    const signupName = signupform.querySelector('[name="name"]');
    const signupEmail = signupform.querySelector('[name="email"]');
    const signupPass = signupform.querySelector('[name="password"]');
    const signupPass2 = signupform.querySelector('[name="password2"]');

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


    //Validates the login form
    const validateLogin = () => {
        let success = true;

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(loginEmail.value)) {
            showError(
                loginEmail,
                "Email address should be non-empty with the format xyx@xyx.xyx."
            );
            success = false;
        } else {
            showSuccess(loginEmail);
        }

        if (loginPass.value.length <= 8) {
            showError(loginPass, "Password should be at least 8 charaters long.");
            success = false;
        } else {
            showSuccess(loginPass);
        }

        return success;
    };

    //Validates the signup form
    const validateSignup = () => {
        let signupSuccess = true;

        if (signupName.value.trim() === "") {
            showError(signupName, "Name should be non-empty.");
            signupSuccess = false;
        } else {
            showSuccess(signupName);
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(signupEmail.value)) {
            showError(
                signupEmail,
                "Email address should be non-empty with the format xyx@xyx.xyx."
            );
            signupSuccess = false;
        } else {
            showSuccess(signupEmail);
        }

        if (signupPass.value.length <= 8) {
            showError(signupPass, "Password should be at least 8 charaters long.");
            signupSuccess = false;
        } else {
            showSuccess(signupPass);
        }

        if (signupPass2.value !== signupPass.value) {
            showError(signupPass2, "Please retype password.");
            signupSuccess = false;
        } else {
            showSuccess(signupPass2);
        }

        return signupSuccess;
    };

    //Stops login form submition if validation fails
    loginform.addEventListener("submit", function (e) {
        console.log("submitting login form...");
        if (!validateLogin()) {
            e.preventDefault();
        }
    });

    //Stops signup form submition if validation fails
    signupform.addEventListener("submit", function (e) {
        console.log("submitting signup form...");
        if (!validateSignup()) {
            e.preventDefault();
        }
    });
});

// Toggles dark mode on and off
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
}
