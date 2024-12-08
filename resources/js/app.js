import "./bootstrap";
import "flowbite";
import "../css/app.css";
import Alpine from "alpinejs";
import "./modal";

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

// modal
// document.addEventListener("DOMContentLoaded", function () {
//     const ajaxModal = document.getElementById("ajaxModal");
//     const modalContent = document.getElementById("modalContent");

//     // Event listener untuk tombol view
//     document.querySelectorAll(".btn-view").forEach((button) => {
//         button.addEventListener("click", function () {
//             const url = this.dataset.url;
//             fetch(url)
//                 .then((response) => response.json())
//                 .then((data) => {
//                     if (data.success) {
//                         modalContent.innerHTML = `
//                             <div class="p-4">
//                                 <h2 class="text-xl font-bold mb-4">Detail Data</h2>
//                                 <p>${JSON.stringify(data.data)}</p>
//                                 <button class="btn-close">Close</button>
//                             </div>
//                         `;
//                         ajaxModal.classList.remove("hidden");
//                     } else {
//                         alert(data.message);
//                     }
//                 });
//         });
//     });

//     // Event listener untuk tombol edit
//     document.querySelectorAll(".btn-edit").forEach((button) => {
//         button.addEventListener("click", function () {
//             const url = this.dataset.url;
//             fetch(url)
//                 .then((response) => response.text())
//                 .then((html) => {
//                     modalContent.innerHTML = html;
//                     ajaxModal.classList.remove("hidden");
//                 });
//         });
//     });

//     // Event listener untuk menutup modal
//     ajaxModal.addEventListener("click", function (e) {
//         if (
//             e.target === ajaxModal ||
//             e.target.classList.contains("btn-close")
//         ) {
//             ajaxModal.classList.add("hidden");
//         }
//     });
// });
