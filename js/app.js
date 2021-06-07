var textWrapper = document.querySelector('.ml3');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: true })
    .add({
        targets: '.ml3 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 150 * (i + 1)
    }).add({
        targets: '.ml3',
        translateY: [0, 0],
        opacity: [1, 0],
        duration: 999999999999999999,
        easing: "easeOutExpo",
        delay: 1000,

    });

var textWrapper = document.querySelector('.ml4');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: true })
    .add({
        targets: '.ml4 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 3950,
        delay: (el, i) => 160 * (i + 1)
    }).add({
        targets: '.ml4',
        translateY: [0, 0],
        opacity: [1, 0],
        duration: 999999999999999999,
        easing: "easeOutExpo",
        delay: 1000,

    });