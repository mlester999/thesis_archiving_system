import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const btn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");
const btnSettings = document.getElementById("settings-btn");
const showSettings = document.getElementById("settings-show");

// Settings Button
btnSettings.addEventListener("click", function () {
    showSettings.classList.toggle("hidden");
});

// Menu Button
btn.addEventListener("click", navToggle);

// Toggle Mobile Menu
function navToggle() {
    btn.classList.toggle("open");
    menu.classList.toggle("flex");
    menu.classList.toggle("hidden");
}

var openmodal = document.querySelectorAll(".modal-open");
for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener("click", function (event) {
        event.preventDefault();
        toggleModal();
    });
}

const overlay = document.querySelector(".modal-overlay");
overlay.addEventListener("click", toggleModal);

var closemodal = document.querySelectorAll(".modal-close");
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener("click", toggleModal);
}

document.onkeydown = function (evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = evt.key === "Escape" || evt.key === "Esc";
    } else {
        isEscape = evt.keyCode === 27;
    }
    if (isEscape && document.body.classList.contains("modal-active")) {
        toggleModal();
    }
};

function toggleModal() {
    const body = document.querySelector("body");
    const modal = document.querySelector(".modal");
    modal.classList.toggle("opacity-0");
    modal.classList.toggle("pointer-events-none");
    body.classList.toggle("modal-active");
}
