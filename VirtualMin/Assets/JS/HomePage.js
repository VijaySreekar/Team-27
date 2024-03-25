// Carousel effect for trending list

document.addEventListener("DOMContentLoaded", function () {
  var mySwiper = new Swiper(".swiper", {
    effect: "coverflow",
    slidesPerView: "2", // To my understanding, this displays 3 products instead of 2 so x = x + 1
    centeredSlides: true, // Is one product displayed under the highlight? Yes so that's true
    loop: true, // Enable infinite loop
    autoplay: { // Automatic rotation through trending products
      delay: 3000, // Time taken to transition to the next product (In milliseconds)
      disableOnInteraction: false, // If someone ever decides they're nosy/impatient and want to scroll through the entire thing,
    },                             // go ahead, the loop won't break :)
    pagination: {
      el: ".swiper-pagination", // Links to the carousel div class in HomePage.php
      clickable: true,
    },
    coverflowEffect: {
      rotate: 0, // Adjust the rotation angle
      stretch: 0, // Adjust the stretch effect
      depth: 100, // Adjust the depth effect
      modifier: 3, // Adjust the modifier value
      slideShadows: true, // Enable slide shadows
    },
  });
});

