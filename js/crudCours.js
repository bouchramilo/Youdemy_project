// add cours model +++++++++++++++++++++++++++++++++++++++++++++++++++++

const addCours = document.querySelector(".addCours");
const close = document.querySelector(".close");
const coursAddModal = document.querySelector(".coursAddModal");
addCours.addEventListener("click", () => {
  coursAddModal.classList.toggle("hidden");
});
close.addEventListener("click", () => {
  coursAddModal.classList.toggle("hidden");
});
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// update cours model +++++++++++++++++++++++++++++++++++++++++++++++++++++

// Sélection des éléments
// const updateCours = document.querySelector(".updateCours");
// const closeU = document.querySelector(".closeU");
// const coursUpdateModal = document.querySelector(".coursUpdateModal");

// Vérifiez si les éléments existent avant d'ajouter des événements
// if (updateCours && closeU && coursUpdateModal) {
//   updateCours.addEventListener("click", () => {
//     coursUpdateModal.classList.toggle("hidden");
//   });

//   closeU.addEventListener("click", () => {
//     coursUpdateModal.classList.toggle("hidden");
//   });
// } else {
//   console.error("Un ou plusieurs éléments DOM nécessaires sont manquants.");
// }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// type cours ++++++++++++++++++++++++++++++++++++++++++++++++++++
const select_type_input = document.getElementById("select_type");
const video_type_input = document.getElementById("type-video");
const text_type_input = document.getElementById("type-text");
select_type_input.addEventListener("change", () => {
  if (select_type_input.value === "Texte") {
    text_type_input.classList.remove("hidden");
    video_type_input.classList.add("hidden");
  }
  if (select_type_input.value === "Video") {
    video_type_input.classList.remove("hidden");
    text_type_input.classList.add("hidden");
  }
});
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// tags select multiple ++++++++++++++++++++++++++++++++++++++++++
new MultiSelectTag("tags"); // id
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
