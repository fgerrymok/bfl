document.getElementById("load-more").addEventListener("click", function () {
  const button = this;
  const currentPage = parseInt(button.getAttribute("data-page"));
  const nextPage = currentPage + 1;
  const originalText = button.textContent;

  if (button.classList.contains("loading")) return;

  button.classList.add("loading");
  button.textContent = "Loading...";

  fetch(ajax_object.ajaxurl, {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      action: "loadmore_posts",
      page: currentPage,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then((data) => {
      const container = document.getElementById("video-container");
      const tempDiv = document.createElement("div");
      tempDiv.innerHTML = data;

      while (tempDiv.firstChild) {
        container.appendChild(tempDiv.firstChild);
      }

      // Update page data and reset button
      button.setAttribute("data-page", nextPage);
      button.textContent = originalText;
      button.classList.remove("loading");

      // If no more data, hide button
      if (!data.trim()) {
        button.style.display = "none";
      }
    })
    .catch((error) => {
      console.error("Error loading more posts:", error);
      button.textContent = originalText;
      button.classList.remove("loading");
      alert("Failed to load more posts. Please try again.");
    });
});
