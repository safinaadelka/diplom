function dictionary(id_word) {
    const button = document.querySelector(
        `button[onclick="dictionary('${id_word}')"]`
    );
    const svg = button.querySelector(".save_svg");

    // Получаем ID пользователя из сессии (например, с помощью PHP или другого серверного языка)
    const id_user = "{{ Auth::user()->id; }}"; // Замените на свой код получения ID пользователя

    // Проверяем, есть ли у кнопки класс "save_svg_active"
    if (svg.classList.contains("save_svg_active")) {
        // Удаляем класс "save_svg_active"
        svg.classList.remove("save_svg_active");

        // Отправляем AJAX-запрос на удаление
        var xhr = new XMLHttpRequest();
        var url = `/delete_dictionary`;

        xhr.open("POST", url, true);

        // Получение CSRF токена
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        // Добавление CSRF токена к данным
        var add_data = new FormData();
        add_data.append("id", parseInt(id_word));
        add_data.append("_token", csrfToken);

        // Обработчик ответа от сервера
        xhr.onreadystatechange = function () {
            var response = JSON.parse(xhr.responseText);
            if (xhr.status >= 200 && xhr.status < 300) {
                console.log("no errors");
                window.location.href = response.url;
            }
            if (xhr.status === 422) {
                // Проверяем статус ответа, который Laravel возвращает при ошибках валидации

                if (response.errors) {
                    console.log("Ошибки валидации:");
                    for (var error in response.errors) {
                        console.log(error + ": " + response.errors[error]);
                    }
                }
                window.location.href = response.url;
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
                console.log("NO errors");
            }
        };

        // Отправка запроса
        xhr.send(add_data);
    } else {
        // Добавляем класс "save_svg_active"
        svg.classList.add("save_svg_active");

        var xhr = new XMLHttpRequest();
        var url = `/save_dictionary`;

        xhr.open("POST", url, true);

        // Получение CSRF токена
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        // Добавление CSRF токена к данным
        var add_data = new FormData();
        add_data.append("id", parseInt(id_word));
        add_data.append("_token", csrfToken);

        // Обработчик ответа от сервера
        xhr.onreadystatechange = function () {
            var response = JSON.parse(xhr.responseText);
            if (xhr.status >= 200 && xhr.status < 300) {
                console.log("no errors");
                window.location.href = response.url;
            }
            if (xhr.status === 422) {
                // Проверяем статус ответа, который Laravel возвращает при ошибках валидации

                if (response.errors) {
                    console.log("Ошибки валидации:");
                    for (var error in response.errors) {
                        console.log(error + ": " + response.errors[error]);
                    }
                }
                window.location.href = response.url;
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
                console.log("NO errors");
            }
        };

        // Отправка запроса
        xhr.send(add_data);
    }
}
