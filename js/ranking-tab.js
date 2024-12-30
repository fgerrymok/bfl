document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".tabs-wrapper ul li button");
  const tabSlider = document.querySelector(".tab-slider");
  const dropdown = document.getElementById("tab-dropdown");
  const sections = document.querySelectorAll(".division-group");

  // Function to update displayed section
  function updateSections(target) {
      sections.forEach((section) => {
          section.style.display = section.id === target ? "block" : "none";
      });
  }

  // Function to update the active button state
  function updateActiveButton(activeButton) {
      buttons.forEach((button) => {
          button.classList.remove("active");
      });
      activeButton.classList.add("active");
  }

  // Function to update the slider position
  function updateSlider(button) {
      if (!button) return;
      const rect = button.getBoundingClientRect();
      const parentRect = button.parentElement.parentElement.getBoundingClientRect();
      tabSlider.style.width = `${rect.width}px`;
      tabSlider.style.left = `${rect.left - parentRect.left}px`;
  }

  // Function to initialize slider for active button
  function initializeSlider() {
      const activeButton = document.querySelector(".tabs-wrapper ul li button.active");
      updateSlider(activeButton);
  }

  // Add click event for desktop buttons
  buttons.forEach((button) => {
      button.addEventListener("click", function () {
          const target = this.getAttribute("data-target");
          updateSections(target);
          updateActiveButton(this);
          updateSlider(this);
      });
  });

  // Add change event for mobile dropdown
  dropdown.addEventListener("change", function () {
      const target = this.value;
      updateSections(target);

      // Find corresponding button for slider
      const correspondingButton = Array.from(buttons).find(
          (button) => button.getAttribute("data-target") === target
      );
      if (correspondingButton) {
          updateActiveButton(correspondingButton);
          updateSlider(correspondingButton);
      }
  });

  // Handle window resizing to recalculate slider position
  window.addEventListener("resize", initializeSlider);

  // Initialize: Show first section and set first button active
  if (buttons.length > 0) {
      buttons[0].classList.add("active");
      updateSections(buttons[0].getAttribute("data-target"));
      updateSlider(buttons[0]);
  }
});
