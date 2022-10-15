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

const labelsBarChart = ["January", "February", "March", "April", "May", "June"];

const dataBarChart = {
    labels: labelsBarChart,
    datasets: [
        {
            label: "My First Dataset",
            backgroundColor: "hsl(252, 82.9%, 67.8%)",
            borderColor: "hsl(252, 82.9%, 67.8%)",
            data: [0, 10, 5, 2, 20, 30, 45],
        },
    ],
};

const configBarChart = {
    type: "bar",
    data: dataBarChart,
    options: {},
};

let chartBar = new Chart(document.getElementById("chartBar"), configBarChart);
