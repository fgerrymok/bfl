document.addEventListener("DOMContentLoaded", () => {
  const copyPopup = document.getElementById("copy-popup");

  document.getElementById("copy-link").addEventListener("click", function () {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
      copyPopup.style.opacity = "1";
      setTimeout(() => {
        copyPopup.style.opacity = "0";
      }, 1000); // Show popup for 1 second
    });
  });
});
