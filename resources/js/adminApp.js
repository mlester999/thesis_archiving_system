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

// Show / Hide Menu of Dropdrop button
const dropDownMenu = document.getElementById("dropdown");
const listMenu = dropDownMenu.querySelectorAll("li");
const mainTableBody = document.getElementById("main-table-body");
// const dropDownTable = document.getElementById("dropdownDefault");

// console.log(dropDownTable);

// console.log(mainTableBody);

listMenu.forEach((list) => {
    list.addEventListener("click", () => {
        dropDownMenu.classList.toggle("hidden");
        dropDownMenu.classList.toggle("block");

        console.log(list);
    });
});

// Modal for Adding Student

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

// Modal for Viewing Student Details

var viewOpenmodal = document.querySelectorAll(".view-modal-open");
for (var i = 0; i < viewOpenmodal.length; i++) {
    viewOpenmodal[i].addEventListener("click", function (event) {
        event.preventDefault();
        toggleViewModal();
    });
}

const viewOverlay = document.querySelector(".view-modal-overlay");
viewOverlay.addEventListener("click", toggleViewModal);

var viewClosemodal = document.querySelectorAll(".view-modal-close");
for (var i = 0; i < viewClosemodal.length; i++) {
    viewClosemodal[i].addEventListener("click", toggleViewModal);
}

document.onkeydown = function (evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = evt.key === "Escape" || evt.key === "Esc";
    } else {
        isEscape = evt.keyCode === 27;
    }
    if (isEscape && document.body.classList.contains("view-modal-active")) {
        toggleModal();
    }
};

function toggleViewModal() {
    const body = document.querySelector("body");
    const viewModal = document.querySelector(".view-modal");
    viewModal.classList.toggle("opacity-0");
    viewModal.classList.toggle("pointer-events-none");
    body.classList.toggle("modal-active");
}
