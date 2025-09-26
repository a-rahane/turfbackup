document.addEventListener('DOMContentLoaded', function() {
    const slides = [
        'images/cricket-slider.webp',
        'images/basketball-slider.webp',
        'images/football-slider.jpeg'
    ];
    let index = 0;
    const img = document.getElementById('slider-img');

    function nextSlide() {
        // Fade out
        img.style.opacity = 0;

        setTimeout(() => {
            // Change the image
            index = (index + 1) % slides.length;
            img.src = slides[index];

            // Fade in
            img.style.opacity = 1;
        }, 1000); // must match CSS transition
    }

    // Change every 3 seconds
    setInterval(nextSlide, 3000);
});
