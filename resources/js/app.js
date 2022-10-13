import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const btn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");

const linkForm = document.getElementById("link-form");

btn.addEventListener("click", navToggle);

// Toggle Mobile Menu
function navToggle() {
    btn.classList.toggle("open");
    menu.classList.toggle("flex");
    menu.classList.toggle("hidden");
}

// Slider
const slides = document.querySelectorAll(".slide");
const btnLeft = document.querySelector(".slider__btn--left");
const btnRight = document.querySelector(".slider__btn--right");

let currSlide = 0;
const maxSlide = slides.length;

const goToSlide = function (slide) {
    slides.forEach((s, index) => {
        s.style.transform = `translateX(${100 * (index - slide)}%)`;
    });
};

goToSlide(0);

const nextSlide = function () {
    if (currSlide === maxSlide - 1) {
        currSlide = 0;
    } else {
        currSlide++;
    }

    goToSlide(currSlide);
};

const prevSlide = function () {
    if (currSlide === 0) {
        currSlide = maxSlide - 1;
    } else {
        currSlide--;
    }

    goToSlide(currSlide);
};

// Previous slide
btnLeft.addEventListener("click", prevSlide);

// Next slide
btnRight.addEventListener("click", nextSlide);
