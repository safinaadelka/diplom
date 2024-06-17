// let cards = document.querySelector(".word_cards");
// let scrollAmount = document.querySelector(".word_card").offsetWidth;
// console.log(scrollAmount);
// let maxFullScrolls = Math.ceil(cards.scrollWidth / scrollAmount) - 2; // Максимальное количество полных оборотов
// console.log(maxFullScrolls);
// let fullScrolls = 0; // Переменная для отслеживания количества полных оборотов
// let i = 1;

// let wordCardsStyles = window.getComputedStyle(cards);
// let cards_width = cards.scrollWidth;

// gap = parseInt(wordCardsStyles.getPropertyValue("grid-gap"));
// console.log(gap);

// // Функция для проверки, является ли устройство мобильным

// // Проверка типа устройства и выполнение соответствующего кода

// // Код для десктопных устройств

// document
//   .querySelector(".word_card_container")
//   .addEventListener("wheel", function (event) {
//     if (event.deltaY != 0) {
//       fullScrolls += Math.sign(event.deltaY); // Увеличиваем или уменьшаем количество полных оборотов в зависимости от направления прокрутки

//       fullScrolls = Math.max(0, Math.min(fullScrolls, maxFullScrolls)); // Ограничиваем значение fullScrolls между 0 и maxFullScrolls

//       cards.style.transform = `translateX(-${
//         fullScrolls * scrollAmount + gap * i
//       }px)`; // Применяем сдвиг в соответствии с количеством полных оборотов
//       if (fullScrolls < maxFullScrolls) {

//         let fuck = fullScrolls * scrollAmount + gap * i; 
//         console.log(fuck); 




//         if(i < maxFullScrolls){
//           i++;
//           console.log("i", i); 
//         }

//       }
//       event.preventDefault();
//     }
//   });

// console.log("Вы используете десктопное устройство");




let cards = document.querySelector(".word_cards");
let scrollAmount = document.querySelector(".word_card").offsetWidth;
console.log(scrollAmount);
let maxFullScrolls = Math.ceil(cards.scrollWidth / scrollAmount) - 2; // Максимальное количество полных оборотов
console.log(maxFullScrolls);
let fullScrolls = 0; // Переменная для отслеживания количества полных оборотов
let i = 1;

let wordCardsStyles = window.getComputedStyle(cards);
let cards_width = document.querySelector(".word_card").offsetWidth;
gap = parseInt(wordCardsStyles.getPropertyValue("grid-gap"));
console.log(gap);

// Функция для проверки, является ли устройство мобильным
function isMobileDevice() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  );
}

// Проверка типа устройства и выполнение соответствующего кода
if (isMobileDevice()) {
  // Код для мобильных устройств
  document.querySelector(".word_card_container").style.overflowX = "scroll"; ;
  document.querySelector(".word_card_container").style.overflowY= "hidden";
  console.log("Вы используете мобильное устройство");

} else {
  // Код для десктопных устройств

  document
    .querySelector(".word_card_container")
    .addEventListener("wheel", function (event) {
      if (event.deltaY != 0) {
        fullScrolls += Math.sign(event.deltaY); // Увеличиваем или уменьшаем количество полных оборотов в зависимости от направления прокрутки

        fullScrolls = Math.max(0, Math.min(fullScrolls, maxFullScrolls)); // Ограничиваем значение fullScrolls между 0 и maxFullScrolls

        cards.style.transform = `translateX(-${
          fullScrolls * scrollAmount + gap * i
        }px)`; // Применяем сдвиг в соответствии с количеством полных оборотов
        if (fullScrolls < maxFullScrolls) {
          if (maxFullScrolls * scrollAmount <= cards_width) {
            i++;
          }
        }
        event.preventDefault();
      }
    });

  console.log("Вы используете десктопное устройство");
}
