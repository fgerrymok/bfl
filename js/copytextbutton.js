document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("copy-link").addEventListener("click", function () {
    const url = window.location.href;
    navigator.clipboard
      .writeText(url)
      .then(() => {
        console.log("URL copied");
      })
      .catch((err) => {
        console.error("copy failed:", err);
      });
  });
});
