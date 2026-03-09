const mainHeader = document.querySelector("#header");
const menuBtn = document.querySelector("#menu-btn");

menuBtn.addEventListener("click", () => {
  mainHeader.dataset.state =
    mainHeader.dataset.state === "active" ? "closed" : "active";
});

// // Dark Mode
// document.addEventListener("DOMContentLoaded", function () {
//   const toggleBtn = document.getElementById("dark-mode-toggle");
//   const body = document.documentElement; // Use root element
//   const darkModeIcon = document.getElementById("dark-mode-icon");

//   // Check saved preference
//   if (localStorage.getItem("theme") === "dark") {
//     body.classList.add("dark");
//     darkModeIcon.textContent = "☀️"; // Sun icon for light mode
//   } else {
//     body.classList.remove("dark");
//     darkModeIcon.textContent = "🌙"; // Moon icon for dark mode
//   }

//   toggleBtn.addEventListener("click", function () {
//     if (body.classList.contains("dark")) {
//       body.classList.remove("dark");
//       localStorage.setItem("theme", "light");
//       darkModeIcon.textContent = "🌙";
//     } else {
//       body.classList.add("dark");
//       localStorage.setItem("theme", "dark");
//       darkModeIcon.textContent = "☀️";
//     }
//   });
// });
