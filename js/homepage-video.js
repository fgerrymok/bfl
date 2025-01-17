const homepage_video = document.querySelectorAll('iframe');
homepage_video.forEach((single_iframe) => {
    console.log(single_iframe);
    single_iframe.setAttribute("allow", "autoplay");
    const video_src = single_iframe.getAttribute("src");
    const autoplay_video = video_src + "&autoplay=1&mute=1";
    console.log(autoplay_video);
    single_iframe.setAttribute("src", autoplay_video);
})