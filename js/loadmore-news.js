document.addEventListener("DOMContentLoaded", () => {
  const loadMoreButton = document.getElementById("load-more");
  const newsContainer = document.getElementById("news-container");

  if (!loadMoreButton || !newsContainer) {
    console.error("Load More Button or News Container is missing.");
    return;
  }

  loadMoreButton.addEventListener("click", () => {
    const currentPage = parseInt(loadMoreButton.dataset.page, 10);
    const postsPerPage = parseInt(loadMoreButton.dataset.perPage, 10);
    const nextPage = currentPage + 1;

    fetch(
      `${bfl_ajax.ajax_url}?action=load_more_posts&page=${nextPage}&posts_per_page=${postsPerPage}`,
      {
        method: "GET",
      }
    )
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          newsContainer.insertAdjacentHTML("beforeend", data.data.html);
          loadMoreButton.dataset.page = nextPage;

          if (!data.data.has_more) {
            loadMoreButton.style.display = "none";
          }
        } else {
          console.error("Failed to load posts:", data);
        }
      })
      .catch((error) => console.error("Error fetching posts:", error));
  });
});
