document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formConnexion");

    form.addEventListener("submit", function (event) {
        let valid = true;

        const email = document.getElementById("email");
        const password = document.getElementById("mot_de_passe");

        // Vérif email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            showError(email, "Email invalide");
            valid = false;
        } else {
            clearError(email);
        }

        // Vérif mot de passe
        if (password.value.trim().length < 6) {
            showError(password, "Le mot de passe doit contenir au moins 6 caractères");
            valid = false;
        } else {
            clearError(password);
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        let error = input.nextElementSibling;
        if (!error || !error.classList.contains("error-message")) {
            error = document.createElement("div");
            error.classList.add("error-message");
            input.insertAdjacentElement("afterend", error);
        }
        error.textContent = message;
        input.classList.add("input-error");
    }

    function clearError(input) {
        let error = input.nextElementSibling;
        if (error && error.classList.contains("error-message")) {
            error.remove();
        }
        input.classList.remove("input-error");
    }
});
