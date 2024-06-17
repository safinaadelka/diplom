let wordPagination = document.querySelector("#wordPagination"); 
const wordLinks = wordPagination.querySelectorAll(".filter"); 
const wordBodies = wordPagination.querySelectorAll(".mydictionary_main"); 


console.log(wordPagination); 

wordLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        wordLinks.forEach((link) => {
            link.classList.remove("filter_active"); 
            e.preventDefault(); 
        })
        link.classList.add("filter_active"); 

        wordBodies.forEach((modul) => {
            modul.classList.remove("mydictionary_main_active");
        })
        wordBodies[index].classList.add("mydictionary_main_active")
        e.preventDefault(); 
    })
} )
