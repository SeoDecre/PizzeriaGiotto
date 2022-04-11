// Get the login and register modals
var loginModal = document.getElementById("login-form");
var registerModal = document.getElementById("register-form");

// Get the login and register links
var loginLink = document.getElementById("login-linker");
var registerLink = document.getElementById("register-linker");

// Get the button that opens the login modal
var btn = document.getElementById("order-button");

// On button click, open the login modal
btn.onclick = function() {
    loginModal.style.display = "block";
}

// On register link click
registerLink.onclick = function() {
    loginModal.style.display="none";
    registerModal.style.display="block";
}

// On login link click
loginLink.onclick = function() {
    loginModal.style.display="block";
    registerModal.style.display="none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === loginModal || event.target === registerModal) {
        loginModal.style.display = "none";
        registerModal.style.display = "none";
    }
}