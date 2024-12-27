jQuery(document).ready(function ($) {
  // Past events Slider
  $(".past-events .slick-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    autoplay: false,
    dots: true,
    arrows: true,
    prevArrow: '<button class="slick-prev">⟨</button>',
    nextArrow: '<button class="slick-next">⟩</button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Receent posts Slider
  $(".recent-posts .slick-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    autoplay: false,
    dots: true,
    arrows: true,
    prevArrow: '<button class="slick-prev">⟨</button>',
    nextArrow: '<button class="slick-next">⟩</button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Videos Slider
  $(".videos .slick-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    autoplay: false,
    dots: true,
    arrows: true,
    prevArrow: '<button class="slick-prev">⟨</button>',
    nextArrow: '<button class="slick-next">⟩</button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Champions Slider
  $(".champions .slick-slider").slick({
    slidesToScroll: 1,
    swipeToSlide: true,
    autoplay: false,
    dots: true,
    arrows: true,
    prevArrow: '<button class="slick-prev">⟨</button>',
    nextArrow: '<button class="slick-next">⟩</button>',
    responsive: [
      {
        breakpoint: 9999,
        settings: {
          slidesToShow: 6,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 430,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
});
