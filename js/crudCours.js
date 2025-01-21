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
