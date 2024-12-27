document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".ranking-header button");
  const dropdown = document.getElementById("tab-dropdown");
  const sections = document.querySelectorAll(".division-group");

  // Function to update displayed section and active state
  function updateSections(target) {
    sections.forEach((section) => {
      section.style.display = section.id === target ? "block" : "none";
    });
  }

  // Function to update active button state
  function updateActiveButton(activeButton) {
    buttons.forEach((button) => {
      button.classList.remove('active');
    });
    activeButton.classList.add('active');
  }

  // Button click event for desktop view
  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const target = this.getAttribute("data-target");
      updateSections(target);
      updateActiveButton(this);
    });
  });

  // Dropdown change event for mobile view
  dropdown.addEventListener("change", function () {
    const target = this.value;
    updateSections(target);
    // Find and update corresponding button
    const correspondingButton = Array.from(buttons).find(
      button => button.getAttribute("data-target") === target
    );
    if (correspondingButton) {
      updateActiveButton(correspondingButton);
    }
  });

  // Initial state: only show the first section and set first button as active
  sections.forEach((section, index) => {
    section.style.display = index === 0 ? "block" : "none";
  });
  if (buttons.length > 0) {
    buttons[0].classList.add('active');
  }

  return;
});