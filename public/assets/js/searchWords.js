let searchValue;


let i = 1;


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
           
        } else {
            elem.classList.remove("visible_card");
            elem.classList.add("hidden_card");
        }
    });
});





