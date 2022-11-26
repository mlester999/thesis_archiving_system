@extends('master')
@section('user')

    <div class="slider h-screen">
        @forelse($sliders as $slider)
        <div class="slide">
            <img class="brightness-50" src="{{ asset('home-sliders/'.$slider->img_url) }}" alt="Slider Image" />
            <h1 class="absolute font-bold mt-40 text-white text-3xl text-center md:text-5xl lg:text-6xl xl:text-7xl tracking-wider mb-4 sm:max-w-md md:max-w-xl lg:max-w-2xl xl:max-w-4xl" style="text-shadow: 2px 1px #000; line-height: 80px;">{{ $slider->title }}</h1>
        </div>

        @empty
        <div class="slide">
            <img class="brightness-50" src="{{ asset('images/pnc1.jpg') }}" alt="Photo 1" />
            <h1 class="absolute font-bold mt-40 text-white text-lg text-center md:text-xl lg:text-3xl xl:text-7xl tracking-wider mb-4" style="text-shadow: 2px 1px #000; line-height: 80px;">Theses and Capstone <span class="block">Projects Archiving</span> System</h1>
        </div>
        @endforelse
      <button class="slider__btn slider__btn--left"><i class="fa-solid fa-chevron-left fa-sm"></i></button>
      <button class="slider__btn slider__btn--right"><i class="fa-solid fa-chevron-right fa-sm"></i></button>
      <div class="dots"></div>
    </div>
    
    <script>
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
    </script>
@endsection
