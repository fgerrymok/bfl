document.getElementById("load-more").addEventListener("click", function () {
  const button = this;
  const currentPage = parseInt(button.getAttribute("data-page"));
  const nextPage = currentPage + 1;

  fetch(ajaxurl, {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      action: "loadmore_posts",
      page: currentPage,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      const container = document.getElementById("video-container");
      const tempDiv = document.createElement("div");
      tempDiv.innerHTML = data;

      while (tempDiv.firstChild) {
        container.appendChild(tempDiv.firstChild);
      }

      container.appendChild(button);

      button.setAttribute("data-page", nextPage);

      if (!data.trim()) {
        button.style.display = "none";
      }
    })
    .catch((error) => console.error("Error loading more posts:", error));
});
