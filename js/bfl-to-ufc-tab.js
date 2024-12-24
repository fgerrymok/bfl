document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".tab-button");
  const contents = document.querySelectorAll(".tab-content");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // Remove active class from all buttons and contents
      buttons.forEach((btn) => btn.classList.remove("active"));
      contents.forEach((content) => (content.style.display = "none"));

      // Add active class to clicked button and show corresponding content
      button.classList.add("active");
      const target = document.getElementById(button.dataset.target);
      if (target) target.style.display = "block";
    });
  });
});
