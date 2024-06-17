let searchValue;

let cardsContainer = document.querySelector(".chose_words");
let i = 1;
let third_add_step = document.querySelector("#third_add_step");

document.getElementById("searchInput").addEventListener("input", function () {
    searchValue = this.value.trim();
    searchValue = searchValue.toLowerCase();
    console.log("searchValue", searchValue);

    let search_cards = document.querySelectorAll(".word_card");

    search_cards.forEach(function (elem) {
        let h3 = elem.querySelector("h3");
        let data_original = h3.getAttribute("data-original").toLowerCase();

        let textP = elem.querySelector(".text2_reg");
        let data_translate = textP.getAttribute("data-translate").toLowerCase();

        console.log(data_translate);
        console.log(data_original);
        if (
            data_original.includes(searchValue) ||
            data_translate.includes(searchValue)
        ) {
            elem.classList.remove("hidden_card");
            elem.classList.add("visible_card");
            console.log(search_count);
        } else {
            elem.classList.remove("visible_card");
            elem.classList.add("hidden_card");
        }
    });
});

let selectedCards = [];
// при редактировании добавить в массив карточки с классом circle selected
let given_cards = [];
let circles = document.querySelectorAll(".selected");
if (circles) {
    circles.forEach(function (circle) {
        let cardNumber = $(circle).closest(".word_card").data("card");
        selectedCards.push(cardNumber);
        let search_count_text = document.querySelector("#search_count");
        search_count_text.innerHTML = "Выбрано слов: " + selectedCards.length;
    });
}

$(document).ready(function () {
    $(document).on("click", ".circle", function () {
        $(this).toggleClass("selected");
        let cardNumber = $(this).closest(".word_card").data("card");
        console.log("cardNumber", cardNumber);
        if ($(this).hasClass("selected")) {
            selectedCards.push(cardNumber);
        } else {
            let index = selectedCards.indexOf(cardNumber);
            console.log(index);
            if (index !== -1) {
                selectedCards.splice(index, 1);
            }
        }

        console.log(selectedCards); // Вывод выбранных карточек в консоль
        if (selectedCards.length === 0) {
            third_add_step.disabled = true;
            document
                .querySelector("#add_step_3")
                .classList.remove("add_step_active");
        } else if (selectedCards.length !== 0) {
            third_add_step.disabled = false;
            document
                .querySelector("#add_step_3")
                .classList.add("add_step_active");
        }

        let search_count_text = document.querySelector("#search_count");
        search_count_text.innerHTML = "Выбрано слов: " + selectedCards.length;
    });
});
