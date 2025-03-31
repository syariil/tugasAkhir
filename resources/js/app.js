import "./bootstrap";
import "flowbite";
import "../css/app.css";
import Alpine from "alpinejs";

Alpine.start();
// If you want Alpine's instance to be available globally
window.Alpine = Alpine;
const bntNext = document.getElementById("btnNext");
const bntPrev = document.getElementById("btnPrev");
const bntSubmit = document.getElementById("btnSubmit");
const stepOne = document.getElementById("step-one-register");
const stepTwo = document.getElementById("step-two-register");

bntPrev.addEventListener("click", function () {
    bntNext.classList.replace("hidden", "block");
    stepOne.classList.replace("hidden", "block");
    bntSubmit.classList.replace("block", "hidden");
    stepTwo.classList.replace("block", "hidden");
});

bntNext.addEventListener("click", function () {
    bntSubmit.classList.replace("hidden", "block");
    stepTwo.classList.replace("hidden", "block");
    bntNext.classList.replace("block", "hidden");
    stepOne.classList.replace("block", "hidden");
});
console.log("admin");
