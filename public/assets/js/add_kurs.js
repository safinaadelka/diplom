let inputs = document.querySelectorAll("input");
let error;
var pass1_error;
var pass2_error;
let animate1;
let animate2;
let errorElement1;
let errorElement2;
let array;



let name_input = document.querySelector("#textarea");
let name_kurs = document.querySelector("#name");
let lessons = document.querySelector("#lessons_input"); 

// проверка описанис урока
name_input.addEventListener("input", function () {
    error = EMPT(name_input.value);

    const errorElement = name_input.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
        FindError(errorElement, name_input);
    } else {
        error = MaxLength2(name_input.value);
        if (error) {
            FindError(errorElement, name_input);
        } else {
            if (errorElement) {
                errorElement.remove();
            }
            name_input.classList.remove("input_error");
        }
    }
});

lessons.addEventListener("change", function () {
    error = EMPT(lessons.value);

    const errorElement = lessons.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
        FindError(errorElement, lessons);
    } else {
        error = MaxLength(lessons.value);
        if (error) {
            FindError(errorElement, name_input);
        } else {
            if (errorElement) {
                errorElement.remove();
            }
            lessons.classList.remove("input_error");
        }
    }
});

lessons.addEventListener("valid", function () {
    error = EMPT(lessons.value);

    const errorElement = lessons.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
        FindError(errorElement, lessons);
    } else {
        error = MaxLength(lessons.value);
        if (error) {
            FindError(errorElement, name_input);
        } else {
            if (errorElement) {
                errorElement.remove();
            }
            lessons.classList.remove("input_error");
        }
    }
});


name_kurs.addEventListener("input", function () {
    error = EMPT(name_kurs.value);


    name_kurs_parent = name_kurs.parentNode; 
    const errorElement = name_kurs_parent.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
        FindError2(errorElement, name_kurs);
    } else {
        error = MaxLength(name_kurs.value);
        if (error) {
            FindError2(errorElement, name_kurs);
        } else {
            if (errorElement) {
                errorElement.remove();
            }
            name_kurs.classList.remove("input_error");
        }
    }
});

function EMPT(value) {
    if (!value.trim()) {
        return "поле не может быть пустым";
    } else {
        return "";
    }
}

function MaxLength(value) {
    if (value.length > 80) {
        return "максимальное кол-во символов - 80";
    } else {
        return "";
    }
}

function MaxLength2(value) {
    if (value.length > 120) {
        return "максимальное кол-во символов - 120";
    } else {
        return "";
    }
}
function FindError2(errorElement, input) {
    input.classList.add("input_error");
    if (!errorElement) {
        name_kurs_parent = name_kurs.parentNode; 
        name_kurs_parent.insertAdjacentHTML(
            "afterend",
            '<p class="error red">' + error + "</p>"
        );
    } else if (errorElement) {
        errorElement.innerHTML = error;
    }
}
function FindError(errorElement, input) {
    input.classList.add("input_error");
    if (!errorElement) {
        input.insertAdjacentHTML(
            "afterend",
            '<p class="error red">' + error + "</p>"
        );
    } else if (errorElement) {
        errorElement.innerHTML = error;
    }
}

// ПРОВЕРКА 1 ШАГА
let first_add_step = document.querySelector("#third_add_step"); 
let first_step = [name_input, name_kurs, lessons];
console.log("first_step", first_step);
first_step.forEach((input) => {
    input.addEventListener("input", checkFormValidity);
    input.addEventListener("change", checkFormValidity);
    input.addEventListener("blur", checkFormValidity);
});

function checkFormValidity() {
    let allInputsFilled = true;
    let errorCount;
    // Проверяем все поля на заполненность
    first_step.forEach((input) => {
        errorCount = document.querySelectorAll(".error").length;
        console.log(document.querySelectorAll(".error"));
        console.log("error", errorCount);

        if (input.value.trim() === "") {
            allInputsFilled = false;
        }
        console.log(allInputsFilled);
    });

    // Если все поля заполнены и количество ошибок равно 0, снимаем атрибут disabled у кнопки
    if (allInputsFilled && errorCount === 0) {
        first_add_step.disabled = false;
       
    } else {
        first_add_step.disabled = true;
    
    }
}
