const countdown = document.getElementsByClassName('countdown-timer-box');
const leftHeader = document.querySelectorAll('.left-header');
const rightHeader = document.querySelectorAll('.right-header');

if ( countdown.length === 0 ) {
    leftHeader.forEach((element) => {
        element.classList.add('no-countdown');
    })

    rightHeader.forEach((element) => {
        element.classList.add('adjusted-navigation');
    })
}