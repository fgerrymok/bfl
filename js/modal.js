document.addEventListener("DOMContentLoaded", () => {
  const thumbnails = document.querySelectorAll(
    ".video-thumbnail, .slider-image"
  );
  const modal = document.getElementById("video-modal");
  const modalContent = document.getElementById("modal-content");
  const closeModal = document.getElementById("close-modal");

  // Open modal with video
  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", (e) => {
      e.preventDefault(); // Prevent default link behavior if any

      // Check if the element is a front-page slider image
      const parentElement = thumbnail.closest(".slider-item");
      if (parentElement) {
        const videoUrl = parentElement.getAttribute("data-video-url");

        // Ensure the video URL is valid
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
      } else {
        // Handle for videos with `data-video-url` directly on thumbnail
        const videoUrl = thumbnail.getAttribute("data-video-url");
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
  });

  // Close modal by clicking on close button
  closeModal.addEventListener("click", () => {
    modalContent.innerHTML = "";
    modal.classList.remove("open");
  });

  // Close modal when clicking anywhere outside the modal content
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modalContent.innerHTML = "";
      modal.classList.remove("open");
    }
  });
});
