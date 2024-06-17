const links = document.querySelectorAll(".reviewer_btn"); 
const citates = document.querySelectorAll(".citate"); 
const texts = document.querySelectorAll(".review_text"); 
const names = document.querySelectorAll(".reviewer_name"); 
const moduls = document.querySelectorAll(".review_link"); 
links.forEach((link, index) => {
    link.addEventListener("click", (e) => {
        links.forEach((link) => {
            link.classList.remove("reviewer_btn_active"); 
            e.preventDefault(); 
        })
        link.classList.add("reviewer_btn_active"); 

        citates.forEach((citate) => {
            citate.classList.remove("citate_active");
        })
        citates[index].classList.add("citate_active")
        e.preventDefault(); 


        texts.forEach((text) => {
            text.classList.remove("review_text_active");
        })
        texts[index].classList.add("review_text_active")
        e.preventDefault(); 


        names.forEach((name) => {
            name.classList.remove("reviewer_name_active");
        })
        names[index].classList.add("reviewer_name_active")
        e.preventDefault(); 


        moduls.forEach((modul) => {
            modul.classList.remove("review_link_active");
        })
        moduls[index].classList.add("review_link_active")
        e.preventDefault(); 
    })
} )

