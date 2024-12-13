jQuery(document).ready(function ($) {
  $("#load-more").on("click", function () {
    const button = $(this);
    const page = parseInt(button.attr("data-page"));
    const nextPage = page + 1;

    $.ajax({
      url: bfl_ajax.ajax_url, // Provided via localized script
      type: "POST",
      data: {
        action: "loadmore_posts",
        page: page,
      },
      beforeSend: function () {
        button.text("Loading...").prop("disabled", true);
      },
      success: function (response) {
        if ($.trim(response)) {
          $("#video-container").append(response);
          button
            .text("Load More")
            .prop("disabled", false)
            .attr("data-page", nextPage);
        } else {
          button.text("No more videos").prop("disabled", true);
        }
      },
    });
  });
});
