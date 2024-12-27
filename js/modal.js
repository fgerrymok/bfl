document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("video-modal");
  const modalContent = document.getElementById("modal-content");
  const closeModal = document.getElementById("close-modal");

  document.body.addEventListener("click", (e) => {
    if (
      e.target.classList.contains("video-thumbnail") ||
      e.target.classList.contains("slider-image")
    ) {
      const thumbnail = e.target;
      const parentElement = thumbnail.closest(".slider-item");

      let videoUrl = null;

      if (parentElement) {
        videoUrl = thumbnail.getAttribute("data-video-url");
      } else {
        videoUrl = thumbnail.getAttribute("data-video-url");
      }

      if (videoUrl) {
        modalContent.innerHTML = `
          <iframe 
            src="${videoUrl}?autoplay=1" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" 
            allowfullscreen>
          </iframe>`;
        modal.classList.add("open");
      }
    }
  });

  closeModal.addEventListener("click", () => {
    modalContent.innerHTML = "";
    modal.classList.remove("open");
  });

  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modalContent.innerHTML = "";
      modal.classList.remove("open");
    }
  });
});
