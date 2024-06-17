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
let file_input = document.querySelector("#fileInput");
let first_add_step = document.querySelector("#first_add_step");

// проверка названия урока
name_input.addEventListener("input", function () {
    error = EMPT(name_input.value);

    const errorElement = name_input.parentNode.querySelector(".error");
    // есть ошибка
    if (error) {
        FindError(errorElement, name_input);
    } else {
        error = MaxLength(name_input.value);
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

function EMPT(value) {
    if (!value.trim()) {
        return "поле не может быть пустым";
    } else {
        return "";
    }
}
// function File(value) {
//     if (value.files && value.files.length > 0) {
//         return "";
//     } else {
//         return "файл не выбран";
//     }
// }
function MaxLength(value) {
    if (value.length > 80) {
        return "максимальное кол-во символов - 80";
    } else {
        return "";
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
let first_step = [name_input];
console.log("first_step", first_step);
first_step.forEach((input) => {
    input.addEventListener("input", checkFormValidity);
    input.addEventListener("change", checkFormValidity);
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
        document.querySelector("#add_step_1").classList.add("add_step_active");
    } else {
        first_add_step.disabled = true;
        document
            .querySelector("#add_step_1")
            .classList.remove("add_step_active");
    }
}

// ПРОВЕРКА 2 ШАГА

document
    .getElementById("third_add_step")
    .addEventListener("click", function () {
        var xhr = new XMLHttpRequest();

        // Получаем текущий URL
        var currentUrl = window.location.href;

        // Ищем часть URL, содержащую id урока
        var lessonId = currentUrl.match(/\/lesson\/(\d+)/);

        if (lessonId) {
            lessonId = lessonId[1]; // Получаем значение id из регулярного выражения
            // Теперь можно использовать lessonId в вашем коде
            console.log("ID урока:", lessonId);
            // Далее можно использовать lessonId для формирования запроса или выполнения других действий
        } else {
            console.log("ID урока не найден в URL");
        }

        var url = "/lesson/" + lessonId + "/edit";

        xhr.open("POST", url, true);
        // xhr.setRequestHeader("Content-Type", "application/json");

        // Получение CSRF токена
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        var content = tinymce.activeEditor.getContent();

        // преобразование в картинку
        var itog_image = document.querySelector(".itog_image");
        let blob;
        if (itog_image) {
            var src = itog_image.src;

            // Убираем начальную часть "data:image/jpeg;base64," чтобы получить чистую base64-строку
            var base64String = src.split(",")[1];

            // Преобразуем base64-строку в Blob
            var byteCharacters = atob(base64String);
            var byteNumbers = new Array(byteCharacters.length);
            for (var i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            blob = new Blob([byteArray], { type: "image/jpeg/jpg" }); // замените 'image/jpeg' на нужный MIME-тип

            // Создаем объект FormData для отправки на сервер (если нужно)
        } else if (!itog_image) {
            blob = new Blob([""]);
        }

        // преобразование в картинку

        // Формирование данных для отправки
        var add_data = new FormData();
        add_data.set("name", name_input.value);
        add_data.set("text", content);
        add_data.append("foto", blob, "filename.jpg");
        // add_data.set("foto", blob);
        add_data.set("words", JSON.stringify(selectedCards));

        console.log(blob);

        // Добавление CSRF токена к данным
        add_data.append("_token", csrfToken);

        // Обработчик ответа от сервера
        xhr.onreadystatechange = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // alert("Успешно прошло");
                var response = JSON.parse(xhr.responseText);
                window.location.href = response.url;
                console.log(response.url);
            }
            if (xhr.status === 422) {
                // Проверяем статус ответа, который Laravel возвращает при ошибках валидации
                var response = JSON.parse(xhr.responseText);
                if (response.errors) {
                    console.log("Ошибки валидации:");
                    for (var error in response.errors) {
                        console.log(error + ": " + response.errors[error]);
                    }
                }
            } else {
                // alert("Не отправлено");
            }
        };
        xhr.onload = function () {
            var response = JSON.parse(xhr.responseText);
            var errorsString = "";
            if (response.errors) {
                console.log("Ошибки валидации:");
                for (var error in response.errors) {
                    console.log(error + ": " + response.errors[error]);
                    errorsString +=
                        "<p class = 'error red'>  Ошибка поля: " +
                        error +
                        ": " +
                        response.errors[error] +
                        "<br> </p>";
                }
            }

            document
                .querySelector(".add_content_up")
                .insertAdjacentHTML(
                    "afterend",
                    "<div>" + errorsString + "</div>"
                );
        };

        // Отправка запроса
        xhr.send(add_data);
        console.log("data" + add_data);

        add_data.forEach(function (value, key) {
            console.log(key + ":" + value);
        });
    });
