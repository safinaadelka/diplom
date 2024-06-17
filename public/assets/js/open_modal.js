let open_word_modal = document.querySelector("#open_word_modal");
let close_word_modal = document.querySelector("#close_word_modal");
let add_word_modal = document.querySelector("#add_word_modal");
let edit_word_modal = document.querySelector("#edit_word_modal");
let delete_word_modal = document.querySelector("#delete_word_modal");
let delete_lesson_modal = document.querySelector("#delete_lesson_modal");

let word_modals = document.querySelectorAll(".word_modal");
console.log(word_modals);
console.log(add_word_modal);
open_word_modal.addEventListener("click", function () {
    add_word_modal.classList.add("word_modal_active");
});
close_word_modal.addEventListener("click", function () {
    add_word_modal.classList.remove("word_modal_active");
    edit_word_modal.classList.remove("word_modal_active");
    delete_word_modal.classList.remove("word_modal_active");
});

word_modals.forEach((word_modal) => {
    let inputs = word_modal.querySelectorAll("input");
    inputs.forEach((input) => {
        input.addEventListener("input", function () {
            error = EMPT(input.value);

            const animate = input.parentNode;
            const errorElement = animate.parentNode.querySelector(".error");
            // есть ошибка
            if (error) {
                FindError(errorElement, input);
            } else {
                errorElement.remove();
                input.classList.remove("input_error");
            }
        });

        word_modal.querySelectorAll("input").forEach((input) => {
            input.addEventListener("input", checkFormValidity);
        });

        function checkFormValidity() {
            let allInputsFilled = true;
            let errorCount = word_modal.querySelectorAll(".error").length;
            console.log("error", errorCount);

            // Проверяем все поля на заполненность
            word_modal.querySelectorAll("input").forEach((input) => {
                if (input.value.trim() === "") {
                    allInputsFilled = false;
                }
                console.log(allInputsFilled);
            });

            // Если все поля заполнены и количество ошибок равно 0, снимаем атрибут disabled у кнопки
            if (allInputsFilled && errorCount === 0) {
                if (word_modal.querySelector("#add_word_btn")) {
                    word_modal
                        .querySelector("#add_word_btn")
                        .removeAttribute("disabled");
                }
                if (word_modal.querySelector("#edit_word_btn")) {
                    word_modal
                        .querySelector("#edit_word_btn")
                        .removeAttribute("disabled");
                }
            } else {
                if (word_modal.querySelector("#add_word_btn")) {
                    word_modal
                        .querySelector("#add_word_btn")
                        .setAttribute("disabled", "disabled");
                }
                console.log(word_modal.querySelector("#add_word_btn"));

                if (word_modal.querySelector("#edit_word_btn")) {
                    word_modal
                        .querySelector("#edit_word_btn")
                        .setAttribute("disabled", "disabled");
                }
            }

            if (allInputsFilled && errorCount === 0) {
                if (word_modal.querySelector("#add_word_btn_first")) {
                    word_modal
                        .querySelector("#add_word_btn_first")
                        .removeAttribute("disabled");
                }
                if (word_modal.querySelector("#edit_word_btn")) {
                    word_modal
                        .querySelector("#edit_word_btn")
                        .removeAttribute("disabled");
                }
            } else {
                if (word_modal.querySelector("#add_word_btn_first")) {
                    word_modal
                        .querySelector("#add_word_btn_first")
                        .setAttribute("disabled", "disabled");
                }
                console.log(word_modal.querySelector("#add_word_btn"));

                if (word_modal.querySelector("#edit_word_btn")) {
                    word_modal
                        .querySelector("#edit_word_btn")
                        .setAttribute("disabled", "disabled");
                }
            }
        }
    });
});

function EMPT(value) {
    if (!value.trim()) {
        return "поле не может быть пустым";
    } else {
        return "";
    }
}
function FindError(errorElement, input) {
    validity = false;
    input.classList.add("input_error");
    if (!errorElement) {
        input.parentNode.insertAdjacentHTML(
            "afterend",
            '<p class="error red">' + error + "</p>"
        );
    } else if (errorElement) {
        errorElement.innerHTML = error;
    }
}

function showModal(original, translate, id) {
    let edit_word_modal = document.querySelector("#edit_word_modal");
    edit_word_modal.querySelector("#original_place").textContent =
        decodeURIComponent(original);
    edit_word_modal.querySelector("#translate_place").textContent =
        decodeURIComponent(translate);

    document.querySelector("#edit_word_form").action = "/word/" + id + "/edit";
    edit_word_modal.classList.add("word_modal_active");
}

function showDeleteModal(original, translate, id) {
    delete_word_modal.classList.add("word_modal_active");
    let edit_word_modal = document.querySelector("#delete_word_modal");
    edit_word_modal.querySelector("#original_place").textContent =
        decodeURIComponent(original);
    edit_word_modal.querySelector("#translate_place").textContent =
        decodeURIComponent(translate);

    document.querySelector("#delete_word_form").action =
        "/word/" + id + "/delete";
    delete_word_modal.classList.add("word_modal_active");
}

function showDeleteLessonModal(id, name) {
    delete_lesson_modal.classList.add("word_modal_active");
    delete_lesson_modal.querySelector("#translate_place").textContent =
        decodeURIComponent(name);

    document.querySelector("#delete_lesson_form").action =
        "/lesson/" + id + "/delete";
    delete_lesson_modal.classList.add("word_modal_active");
}

function hideModal() {
    edit_word_modal.classList.remove("word_modal_active");
    delete_word_modal.classList.remove("word_modal_active");
    delete_lesson_modal.classList.remove("word_modal_active");
}

let add_word_btn = document.querySelector("#add_word_btn");

add_word_btn.addEventListener("click", function () {
    var xhr = new XMLHttpRequest();
    var url = "/add_ajax_word";

    xhr.open("POST", url, true);
    // xhr.setRequestHeader("Content-Type", "application/json");

    // Получение CSRF токена
    var csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    let originalValue = document.querySelector("#original").value;
    let translateValue = document.querySelector("#translate").value;

    // Формирование данных для отправки
    var add_data = new FormData();
    add_data.set("original", originalValue);
    add_data.set("translate", translateValue);

    // Добавление CSRF токена к данным
    add_data.append("_token", csrfToken);

    // Обработчик ответа от сервера
    xhr.onreadystatechange = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // alert("Успешно прошло");
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
        } else {
            var responseSuccess = JSON.parse(xhr.responseText);
            console.log(responseSuccess.original);

            chose_words = document.querySelector("#chose_words");
            chose_words.insertAdjacentHTML(
                "afterbegin",
                `<div class="word_card" data-card="${responseSuccess.id}">
                  <div class="word_card_up">
                    <div class="word_card_left">
                      <h3 data-original="${responseSuccess.original}">
                        ${responseSuccess.original}
                      </h3>
                      <p data-translate="${responseSuccess.translate}" class="text2_reg">
                        ${responseSuccess.translate}
                      </p>
                    </div>
                    <div class="word_card_actions">
                      <div class="circle"></div>
                    </div>
                  </div>
                </div>`
            );
            add_word_modal.classList.remove("word_modal_active");
            document.querySelector("#original").value = "";
            document.querySelector("#translate").value = "";
        }
    };

    // Отправка запроса
    xhr.send(add_data);
    console.log("data" + add_data);

    add_data.forEach(function (value, key) {
        console.log(key + ":" + value);
    });
});
