document.addEventListener("DOMContentLoaded", () => {
    const thumbnails = document.querySelectorAll(".video-thumbnail");
    const modal = document.getElementById("video-modal");
    const modalContent = document.getElementById("modal-content");
    const closeModal = document.getElementById("close-modal");

    // Open modal with video
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener("click", () => {
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
        });
    });

    // Close modal by clicking on close button
    closeModal.addEventListener("click", () => {
        modalContent.innerHTML = ""; 
        modal.classList.remove("open");
    });

    // Close modal when clicking anywhere outside the modal content
    modal.addEventListener("click", (e) => {
        // Close if the clicked area is outside the modal-inner
        if (e.target === modal) {
            modalContent.innerHTML = "";
            modal.classList.remove("open");
        }
    });
});
