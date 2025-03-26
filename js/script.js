/*This function toggles between darkmode and light mode*/
function toggleDarkMode() {
    const body = document.body;
    const header = document.querySelector('header');
    
    body.classList.toggle('dark-mode');
    header.classList.toggle('dark-mode');
};

const popoutButton = document.getElementById("popout-button");
const popoutForm = document.getElementById("popout-form");
const closeButton = document.getElementById("close-popout");

/*This function opens the opens the sign in popup form*/ 
popoutButton.addEventListener("click", () => {
  popoutForm.classList.add("active");
});

/*This function closes the sign in popup form*/ 
closeButton.addEventListener("click", () => {
  popoutForm.classList.remove("active");
});

/*This function will close the popup if mouse is clicked outside of the popup area*/
document.addEventListener("click", (e) => {
  if (!popoutForm.contains(e.target) && e.target !== popoutButton) {
    popoutForm.classList.remove("active");
  }
});

const email = document.getElementById('email');
const password = document.getElementById('pass');
const password2 = document.getElementById('pass2');
const checkBox = document.getElementById('terms');
const form = document.getElementById('form');


/*This function prevents form submission in order to validate*/
form.addEventListener('submit', (e) => {
    e.preventDefault(); 

    validateInputs();
});

const setError = (element, message) => {
    const formcontainer = element.parentElement;
    const errorDisplay = formcontainer.querySelector('.error');

    errorDisplay.innerText = message;
    formcontainer.classList.add('error');
    formcontainer.classList.remove('success');
};

const setSuccess = (element) => {
    const formcontainer = element.parentElement;
    const errorDisplay = formcontainer.querySelector('.error');

    errorDisplay.innerText = ''; 
    formcontainer.classList.add('success');
    formcontainer.classList.remove('error');
};

/*This function validates the inputs*/
function validate() {
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    const checkBoxValue = checkBox.value.trim();

    if (emailValue === '' || !/\S+@\S+\.\S+/.test(emailValue)) {
        setError(email, 'X Enter a valid email (xxx@yyy.zzz)');
    } else {
        setSuccess(email);
    }

    if (passwordValue === '' || passwordValue.length < 6 || !/[A-Z]/.test(passwordValue) || !/[a-z]/.test(passwordValue)) {
        setError(password, 'X Password must be at least 6 characters with 1 uppercase & 1 lowercase letter');
    } else {
        setSuccess(password);
    }

    if (password2Value !== passwordValue || password2Value === '') {
        setError(password2, 'X Passwords do not match');
    } else {
        setSuccess(password2);
    }

    if (checkBox.checked == false) {
        setError(checkBox, 'X Please agree to the terms')
    }   else {
        setSuccess(checkBox);
    }
};
 
