// TODO
// 1. actively listen for user input and clear error messages as the user corrects their input.

document.addEventListener("DOMContentLoaded", () => {
    console.log('DOM loaded');

    const loginform = document.getElementById('loginform');
    const signupform = document.getElementById('signupform');

    /* login form get docs */
    const loginEmail = loginform.querySelector('[name="email"]');
    const loginPass = loginform.querySelector('[name="password"]');

    /* signin form get docs */
    const signupName = signupform.querySelector('[name="name"]');
    const signupEmail = signupform.querySelector('[name="email"]');
    const signupPass = signupform.querySelector('[name="password"]');
    const signupPass2 = signupform.querySelector('[name="password2"]');

    const showError = (element, message) => {
        const field = element.parentElement;
        const errorBox = field.querySelector('.error');
        errorBox.innerText = message;
    };

    const showSuccess = (element) => {
        const field = element.parentElement;
        const errorBox = field.querySelector('.error');
        errorBox.innerText = '';
    };

    const validateLogin = () => {
        let success = true;

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(loginEmail.value)) {
            showError(loginEmail, 'Email address should be non-empty with the format xyx@xyx.xyx.');
            success = false;
        }   else {
            showSuccess(loginEmail);
        }

        if (loginPass.value.length <= 8) {
            showError(loginPass, 'Password should be at least 8 charaters long.');
            success = false;
        }   else {
            showSuccess(loginPass);
        }

        return success;
    };

    const validateSignup = () => {
        let signupSuccess = true;

        if (signupName.value.trim() === "") {
            showError(signupName, 'Name should be non-empty.');
            signupSuccess = false;
        }   else {
            showSuccess(signupName);
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(signupEmail.value)) {
            showError(signupEmail, 'Email address should be non-empty with the format xyx@xyx.xyx.');
            signupSuccess = false;
        }   else {
            showSuccess(signupEmail);
        }

        if (signupPass.value.length <= 8) {
            showError(signupPass, 'Password should be at least 8 charaters long.');
            signupSuccess = false;
        }   else {
            showSuccess(signupPass);
        }

        if (signupPass2.value !== signupPass.value) {
            showError(signupPass2, 'Please retype password.');
            signupSuccess = false;
        }   else {
            showSuccess(signupPass2);
        } 

        return signupSuccess;

    };


    loginform.addEventListener('submit', function (e) {
            console.log('submitting login form...');
            if (!validateLogin()) {
                e.preventDefault();
            }
        });
        
    signupform.addEventListener('submit', function (e) {
            console.log('submitting signup form...');
            if (!validateSignup()) {
                e.preventDefault();
            }
        });        

});

function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
}