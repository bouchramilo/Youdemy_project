const addCours = document.querySelector(".addCours");
const close = document.querySelector(".close");
const coursAddModal = document.querySelector(".coursAddModal");
addCours.addEventListener("click", () => {
  coursAddModal.classList.toggle("hidden");
});
close.addEventListener("click", () => {
  coursAddModal.classList.toggle("hidden");
});
