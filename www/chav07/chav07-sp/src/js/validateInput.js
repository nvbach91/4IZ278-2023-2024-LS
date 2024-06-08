document.addEventListener("DOMContentLoaded", ()=> disableButton());


function validatePasswordInput(element){
    const password = element.value;
    const submitButton = document.getElementById("registerSubmit");

    if(checkPasswordValidity(password)){
        element.setCustomValidity("");
    }
    else{

        element.setCustomValidity("The password must cointain a-z, A-Z, 0-9, one of #?!@$ %^&*_-, length >= 8");
        submitButton.disabled = true;

    }
}
function checkPasswordValidity(password){
    const regex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*_-]).{8,}$");
    return regex.test(password)
}

function validatePasswordAgainInput(element){
    const submitButton = document.getElementById("registerSubmit");
    const passwordAgain = element.value;
    const passwordElement = document.getElementById("registerPassword");
    if(passwordAgain === passwordElement.value){
        element.setCustomValidity("");
        submitButton.disabled = false;
        
    }
    else{
        element.setCustomValidity("Passwords don't match");
        submitButton.disabled = true;
    }
}
function disableButton(){
    const submitButton = document.getElementById("registerSubmit");
    submitButton.disabled = true;

}

function setWasValidated(){
    const form = document.getElementById("regForm");
    if(!form.classList.contains("was-validated")){
        form.classList.add("was-validated");
    }
    
}
function onEmptyQuery(filedId){
    const el = document.getElementById(filedId);
    if(el.value == ""){
        return false;
    }
    return true;
}