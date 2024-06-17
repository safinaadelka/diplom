const slides = document.querySelector(".news_card");
const slideWidth = document.querySelector(".new").offsetWidth + 35;
console.log(slideWidth); 
let currentSlide = 0;

function goToSlide(slideIndex) {
  let translate = slideWidth * slideIndex;
  slides.style.transform = `translateX(-${translate}px)`;
  currentSlide = slideIndex;
}
document.getElementById("prev").addEventListener("click", function () {
  if (currentSlide > 0) {
    goToSlide(currentSlide - 1);
  } else if (currentSlide == 0) {
    // дополнительно
    goToSlide(slides.children.length - 3);
  }
});
document.getElementById("next").addEventListener("click", function () {
  if (currentSlide < slides.children.length - 3) {
    goToSlide(currentSlide + 1);
  } else if (currentSlide == slides.children.length - 3) {
    // дополнительно
    goToSlide(0);
  }
});
