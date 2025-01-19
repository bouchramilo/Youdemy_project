let searchInput = document.getElementById("search");
let coursList = document.getElementById("courses");

searchInput.addEventListener("keyup", () => {
  let query = searchInput.value.toLowerCase();

  Array.from(coursList.children).forEach((course) => {
    let titleElement = course.querySelector("h3");
    if (titleElement) {
      let title = titleElement.textContent.toLowerCase();
      course.style.display = title.includes(query) ? "" : "none";
    }
  });
});
