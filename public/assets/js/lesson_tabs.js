const filterPagination = document.querySelector("#filterPagination"); 
const filterLinks = filterPagination.querySelectorAll(".filter"); 
const filterBodies = filterPagination.querySelectorAll(".program_cards"); 




filterLinks.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        filterLinks.forEach((link) => {
            link.classList.remove("filter_active"); 
            e.preventDefault(); 
        })
        link.classList.add("filter_active"); 

        filterBodies.forEach((modul) => {
            modul.classList.remove("program_cards_active");
        })
        filterBodies[index].classList.add("program_cards_active")
        e.preventDefault(); 
    })
} )
