document.querySelector(".toggle-password").addEventListener("click", function () {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.innerHTML = `
            <path d="M17.94 17.94a10.86 10.86 0 0 1-5.94 2.06c-7 0-11-8-11-8a21.22 21.22 0 0 1 3.1-4.8"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        `; // چشم بسته
    } else {
        passwordField.type = "password";
        eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        `; // چشم باز
    }
});