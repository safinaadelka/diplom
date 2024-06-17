let lastScrollTop = 0;
const header = document.querySelector("header");

window.addEventListener('scroll', function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // Скролл вниз
    header.style.top = '-100px'; // Скрываем шапку
  } else {
    // Скролл вверх
    header.style.top = '0'; // Показываем шапку
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Для обработки случая, когда скролл вверх доходит до верхней границы
});
