function getSelectedRadio(name) {
    const radios = $(`input[type="radio"][name="${name}"]`).toArray();
    for (const radio of radios) {
        if (radio.checked) {
            return radio;
        }
    }
    return null;
}

function checkPasswords() {
    var password = $('#password').val();
    var confirm = $('#confirmPassword').val();

    if (password.length < 8) {
        return false;
    }

    if (password != confirm) {
        return false;
    }

    return true;
}

function checkRegisterForm() {
    const email = $("#email");
    const password = $("#password");
    const confirm = $("#confirmPassword");
    const firstName = $("#firstName");
    const lastName = $("#lastName");
    const birthDate = $("#birthDate");
    const phone = $("#phone");

    const elements = [email, password, confirm, firstName, lastName, birthDate, phone];
    for (const element of elements) {
        let value = $(element).val().trim();
        if (value == "" || value == null || value == undefined) {
            return false;
        }
    }

    if (!checkPasswords()) {
        return false;
    }

    const phoneRegex = /^(\+420)?\d{9}$/;
    if (!phoneRegex.test(phone.val().trim())) {
        return false;
    }

    return true;
}