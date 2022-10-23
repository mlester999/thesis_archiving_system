import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Elements
const slides = document.querySelectorAll(".slide");
const btnLeft = document.querySelector(".slider__btn--left");
const btnRight = document.querySelector(".slider__btn--right");
const dotContainer = document.querySelector(".dots");

setTimeout(() => {
    slides.forEach((el, i) => {
        el.style.transition = "transform 1s";
    });
}, 100);

// Images Sliders in the Home Page
const sliders = function () {
    let currSlide = 0;
    const maxSlide = slides.length;

    // Functions
    const createDots = function () {
        slides.forEach((_, index) => {
            dotContainer.insertAdjacentHTML(
                "beforeend",
                `<button class="dots__dot" data-slide="${index}"></button>`
            );
        });
    };

    const activateDot = function (slide) {
        document
            .querySelectorAll(".dots__dot")
            .forEach((dot) => dot.classList.remove("dots__dot--active"));

        document
            .querySelector(`.dots__dot[data-slide="${slide}"]`)
            .classList.add("dots__dot--active");
    };

    const goToSlide = function (slide) {
        slides.forEach((s, index) => {
            s.style.transform = `translateX(${100 * (index - slide)}%)`;
        });
    };

    const nextSlide = function () {
        if (currSlide === maxSlide - 1) {
            currSlide = 0;
        } else {
            currSlide++;
        }

        goToSlide(currSlide);
        activateDot(currSlide);
    };

    const prevSlide = function () {
        if (currSlide === 0) {
            currSlide = maxSlide - 1;
        } else {
            currSlide--;
        }

        goToSlide(currSlide);
        activateDot(currSlide);
    };

    const init = function () {
        goToSlide(0);
        createDots();
        activateDot(0);
    };
    init();

    // Event Handlers
    btnLeft.addEventListener("click", prevSlide);
    btnRight.addEventListener("click", nextSlide);

    dotContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("dots__dot")) {
            const { slide } = e.target.dataset;
            goToSlide(slide);
            activateDot(slide);
        }
    });

    setInterval(nextSlide, 5000);
};

sliders();
