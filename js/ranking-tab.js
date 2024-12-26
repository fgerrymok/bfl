document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".ranking-header button");
  const sections = document.querySelectorAll(".division-group");

  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const target = this.getAttribute("data-target");

      sections.forEach((section) => {
        if (section.id === target) {
          section.style.display = "block";
        } else {
          section.style.display = "none";
        }
      });
    });
  });

  // initial state: only show first tab
  sections.forEach((section, index) => {
    section.style.display = index === 0 ? "block" : "none";
  });
});
