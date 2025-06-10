//controlli lato client per migliorare esperienza utente

function checkNameSurname(event) {
    const input = event.currentTarget;
    const errorMessageSpan = input.parentNode.querySelector('.error-message');
    const isValid = input.value.length > 0;
    formStatus[input.name] = isValid; //input.name="name" o "surname"

    if (isValid) {
        input.parentNode.classList.remove('error');
        errorMessageSpan.textContent = ''; 
    } else {
        input.parentNode.classList.add('error');
        errorMessageSpan.textContent = 'Questo campo è obbligatorio.';
    }
}

function jsonCheckUsername(json) {
    const usernameInput = document.querySelector('#username');
    const errorMessageSpan = usernameInput.parentNode.querySelector('.error-message');
    formStatus.username = !json.exists;

    if (formStatus.username) {
        usernameInput.parentNode.classList.remove('error');
        errorMessageSpan.textContent = '';
    } else {
        errorMessageSpan.textContent = "Username già utilizzato";
        usernameInput.parentNode.classList.add('error');
    }
}

function jsonCheckEmail(json) {
    const emailInput = document.querySelector('#email');
    const errorMessageSpan = emailInput.parentNode.querySelector('.error-message');
    formStatus.email = !json.exists;

    if (formStatus.email) {
        emailInput.parentNode.classList.remove('error');
        errorMessageSpan.textContent = '';
    } else {
        errorMessageSpan.textContent = "Email già utilizzata";
        emailInput.parentNode.classList.add('error');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const usernameInput = event.currentTarget;
    const errorMessageSpan = usernameInput.parentNode.querySelector('.error-message');

    if(!/^[a-zA-Z0-9_]{3,15}$/.test(usernameInput.value)) {
        errorMessageSpan.textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        usernameInput.parentNode.classList.add('error');
        formStatus.username = false;
    } else {
        errorMessageSpan.textContent = '';
        usernameInput.parentNode.classList.remove('error');
        fetch("check_username.php?q="+encodeURIComponent(usernameInput.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = event.currentTarget;
    const errorMessageSpan = emailInput.parentNode.querySelector('.error-message');

    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        errorMessageSpan.textContent = "Email non valida";
        emailInput.parentNode.classList.add('error');
        formStatus.email = false;
    } else {
        errorMessageSpan.textContent = '';
        emailInput.parentNode.classList.remove('error');
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = event.currentTarget;
    const errorMessageSpan = passwordInput.parentNode.querySelector('.error-message');
    const password = passwordInput.value;
    
    let isValid = true;
    let errorMessage = '';
    
    if (password.length < 8) {
        isValid = false;
        errorMessage = 'La password deve contenere almeno 8 caratteri';
    } else if (!/[A-Z]/.test(password)) {
        isValid = false;
        errorMessage = 'La password deve contenere almeno una lettera maiuscola';
    } else if (!/[a-z]/.test(password)) {
        isValid = false;
        errorMessage = 'La password deve contenere almeno una lettera minuscola';
    } else if (!/[0-9]/.test(password)) {
        isValid = false;
        errorMessage = 'La password deve contenere almeno un numero';
    } else if (!/[^a-zA-Z0-9]/.test(password)) {
        isValid = false;
        errorMessage = 'La password deve contenere almeno un simbolo speciale';
    }
    
    formStatus.password = isValid;

    if (isValid) {
        passwordInput.parentNode.classList.remove('error');
        errorMessageSpan.textContent = ''; 
    } else {
        passwordInput.parentNode.classList.add('error');
        errorMessageSpan.textContent = errorMessage;
    }
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = event.currentTarget;
    const errorMessageSpan = confirmPasswordInput.parentNode.querySelector('.error-message');
    const isCorrect = confirmPasswordInput.value === document.querySelector('#password').value;
    formStatus.confirmPassword = isCorrect; 

    if (isCorrect) {
        confirmPasswordInput.parentNode.classList.remove('error');
        errorMessageSpan.textContent = '';
    } else {
        confirmPasswordInput.parentNode.classList.add('error');
        errorMessageSpan.textContent = 'Le password non coincidono.';
    }
}

function checkSignup(event) {
    console.log('Submit tentato');
    console.log('Stato form:', formStatus);
    
    const checkbox = document.querySelector('#allow');
    const checkboxErrorSpan = checkbox.parentNode.querySelector('.error-message');
    
    if (!checkbox.checked) {
        checkboxErrorSpan.textContent = 'Devi accettare i termini e condizioni';
        checkbox.parentNode.classList.add('error');
        event.preventDefault();
        return;
    } else {
        checkboxErrorSpan.textContent = '';
        checkbox.parentNode.classList.remove('error');
    }
    
    // Verifica tutti i campi del form
    const requiredFields = ['name', 'surname', 'username', 'email', 'password', 'confirmPassword'];
    let allValid = true;
    
    for (let field of requiredFields) {
        if (!formStatus[field]) {
            allValid = false;
            break;
        }
    }
    
    // Se non tutti i campi sono validi, impedisci l'invio
    if (!allValid) {
        const formErrorSpan = document.querySelector('#form-error .error-message');
        formErrorSpan.textContent = 'Completa tutti i campi correttamente prima di procedere';
        event.preventDefault();
        return;
    }
    
    console.log('Submit consentito');
}

const formStatus = {}; // per tenere traccia della validazione
const form = document.querySelector('form');

if (form) {
    form.name.addEventListener('blur', checkNameSurname);
    form.surname.addEventListener('blur', checkNameSurname);
    form.username.addEventListener('blur', checkUsername);
    form.email.addEventListener('blur', checkEmail);
    form.password.addEventListener('blur', checkPassword);
    form.confirm_password.addEventListener('blur', checkConfirmPassword);
    form.addEventListener('submit', checkSignup);
    
    console.log('Event listeners registrati correttamente');
} else {
    console.error('Form non trovato');
}