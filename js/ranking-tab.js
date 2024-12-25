document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".ranking-header button");
  const dropdown = document.getElementById("tab-dropdown");
  const sections = document.querySelectorAll(".division-group");

  // Function to update displayed section
  function updateSections(target) {
    sections.forEach((section) => {
      section.style.display = section.id === target ? "block" : "none";
    });
  }

  // Button click event for desktop view
  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const target = this.getAttribute("data-target");
      updateSections(target);
    });
  });

  // Dropdown change event for mobile view
  dropdown.addEventListener("change", function () {
    const target = this.value;
    updateSections(target);
  });

  // Initial state: only show the first section
  sections.forEach((section, index) => {
    section.style.display = index === 0 ? "block" : "none";
  });
});
