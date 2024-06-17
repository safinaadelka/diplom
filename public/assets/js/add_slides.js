let add_slides = document.getElementById("add_slides");
console.log("add_slides", add_slides);
let addSlideWidth = document.querySelector(".add_slide").offsetWidth + 0;
console.log(addSlideWidth);
currentSlide = 0;
// add_slides.style.maxHeight = `${add_slides.children[0].clientHeight}px`;

function goToSlide(slideIndex) {
    let translate = addSlideWidth * slideIndex;
    add_slides.style.transform = `translateX(-${translate}px)`;
    currentSlide = slideIndex;
}

