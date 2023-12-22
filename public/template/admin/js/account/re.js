const rmCheck = document.getElementById("rememberMe");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
if (localStorage.checkbox && localStorage.checkbox !== "") {
    rmCheck.setAttribute("checked", "checked");
    emailInput.value = localStorage.id_base;
    passwordInput.value = localStorage.pass_base; //
} else {
    rmCheck.removeAttribute("checked");
    emailInput.value = "";
    passwordInput.value = ""; //
}
function lsRememberMe() {
    if (rmCheck.checked && emailInput.value !== "") {
        localStorage.id_base = bytesToBase64(new TextEncoder().encode(emailInput.value));
        localStorage.pass_base = bytesToBase64(new TextEncoder().encode(passwordInput.value));
        localStorage.checkbox = rmCheck.value;
    } else {
        localStorage.id_base = "";
        localStorage.pass_base = ""; //
        localStorage.checkbox = "";
    }
}
function base64ToBytes(base64) {
    const binString = atob(base64);
    return Uint8Array.from(binString, (m) => m.codePointAt(0));
}

function bytesToBase64(bytes) {
    const binString = String.fromCodePoint(...bytes);
    return btoa(binString);
}
var password = new TextDecoder().decode(base64ToBytes(localStorage.pass_base));
var username = new TextDecoder().decode(base64ToBytes(localStorage.id_base));
passwordInput.value = password;
emailInput.value = username;
