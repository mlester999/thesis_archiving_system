import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const btn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");

// Menu Button
btn.addEventListener("click", navToggle);

// Toggle Mobile Menu
function navToggle() {
    btn.classList.toggle("open");
    menu.classList.toggle("flex");
    menu.classList.toggle("hidden");
}
