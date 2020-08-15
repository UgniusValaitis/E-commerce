const button = document.querySelector("aside div.top");
const filters = document.querySelector("aside div.bottom");

button.addEventListener("click", () => {
  filters.classList.toggle("active");
  button.classList.toggle("active");
});
