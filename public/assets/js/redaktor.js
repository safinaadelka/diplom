tinymce.init({
    selector: ".redaktor",
    plugins: "lists link image textcolor",
    toolbar:
        "undo redo | formatselect | bold italic underline| alignleft aligncenter | bullist numlist | link image | h2 h3 | grammar | example | backcolor",
    menubar: false,
    content_css: ["default"],
    paste_as_text: false,
    paste_retain_style_properties: false,
    // color_map: [
    //     "#C2EBFF", "#AFEDC1", "#FFA8A6", "#E4D8FF" // задаем разрешенные цвета в формате HEX
    // ],
    color_map: [
        "C2EBFF",
        "sky",
        "AFEDC1",
        "light green",
        "FFA8A6",
        "coral",
        "E4D8FF",
        "violet",
    ],
    automatic_2color: false,
    setup: function (editor) {
        // editor.on('init', function () {
        //     editor.dom.select('p').forEach(function (node) {
        //         if (!editor.dom.hasClass(node, 'text3')) {
        //             editor.dom.addClass(node, 'text3');
        //         }
        //     });
        // });

        // вставка текста без исходного форматирования
        editor.on("paste", function (e) {
            e.preventDefault();
            var clipboardData = e.clipboardData || window.clipboardData;
            var pastedData = clipboardData.getData("text/plain");

            // Преобразовать текст в HTML с абзацами
            pastedData = pastedData.replace(/\n/g, "<br>"); // Заменяем переводы строки на `<br>`
            pastedData = pastedData.replace(/^/gm, "<p>"); // Добавляем `<p>` в начало каждого абзаца
            pastedData = pastedData.replace(/$/gm, "</p>"); // Добавляем `</p>` в конец каждого абзаца
            pastedData = pastedData.replace(/<p>\s*<p>/g, "<p>"); // Удаляем пустые абзацы

            // Вставить HTML в редактор
            editor.execCommand("mceInsertContent", false, pastedData);
        });

        // editor.processParagraphs = function () {
        //     const paragraphs = editor.dom.select('p');

        //     paragraphs.forEach(paragraph => {
        //         if (editor.dom.hasClass(paragraph, 'text2')) {
        //             console.log("класс был удален");
        //             editor.dom.removeClass(paragraph, 'text3');
        //         }
        //     });
        // }

        //добавление класса text3 ко всем абзацам
        editor.on("NodeChange", function (e) {
            if (e.element.tagName === "P") {
                if (editor.dom.hasClass(e.element, "text2")) {
                    editor.dom.removeClass(e.element, "text3");
                } else if (!editor.dom.hasClass(e.element, "text3")) {
                    editor.dom.addClass(e.element, "text3");
                }
            } else {
                if (editor.dom.hasClass(e.element, "text3")) {
                    editor.dom.removeClass(e.element, "text3");
                }
            }
        });

        // кнопка ГРАММАТИКА
        var isGrammarActive = false;
        editor.ui.registry.addButton("grammar", {
            text: "Грамматика",
            onAction: function () {
                var selectedContent = editor.selection.getContent({
                    format: "html",
                });
                // var range = selectedContent.getRangeAt(0);
                console.log("sc", selectedContent);

                // отмена карточки
                if (selectedContent.includes("grammar_card")) {
                    console.log("отмена карточки");

                    let grammar_text = selectedContent.trim();
                    console.log(grammar_text);
                    // Регулярное выражение
                    let regex = /<div class="grammar_card_down">(.*?)<\/div>/gs;

                    // Находим все вхождения с помощью метода match
                    let result = grammar_text.match(regex);
                    console.log("result", result);
                    // Если найдены вхождения, извлекаем содержимое между тегами
                    let innerContent;
                    if (result) {
                        innerContent = result.map((match) => {
                            return match.replace(
                                /<div class="grammar_card_down">|<\/div>/g,
                                ""
                            );
                        });

                        console.log("inner", innerContent);
                    }

                    var newContent = innerContent;
                    console.log("new", newContent);

                    editor.selection.setContent(newContent, {
                        format: "html",
                    });
                    isGrammarActive = false;
                    editor.ui.registry.get("grammar").icon = "";
                } else {
                    // Добавляем класс, если его нет
                    let newContent =
                        '<p class="text3"><br></p>' +
                        '<div class="grammar_card">' +
                        '<div class="grammar_card_top">' +
                        '<p class="text2" contenteditable="false">Грамматика</p>' +
                        "</div>" +
                        '<div class="grammar_card_down">' +
                        '<p class="text3">' +
                        selectedContent +
                        "</p>" +
                        "</div>" +
                        "</div>" +
                        '<p class="text3"><br></p>';
                    editor.selection.setContent(newContent, {
                        format: "html",
                    });
                    isGrammarActive = true;
                    console.log("ddd");
                    editor.ui.registry.get("grammar").icon = "checkmark";
                }
            },
        });

        // кнопка Примеры
        var isExampleActive = false;
        editor.ui.registry.addButton("example", {
            text: "Примеры",
            onAction: function () {
                var selectedContent = editor.selection.getContent({
                    format: "html",
                });
                // var range = selectedContent.getRangeAt(0);
                console.log("sc", selectedContent);

                // отмена карточки
                if (selectedContent.includes("example_card")) {
                    console.log("отмена карточки");

                    let grammar_text = selectedContent.trim();
                    console.log(grammar_text);
                    // Регулярное выражение
                    let regex = /<div class="example_card_down">(.*?)<\/div>/gs;

                    // Находим все вхождения с помощью метода match
                    let result = grammar_text.match(regex);
                    console.log("result", result);
                    // Если найдены вхождения, извлекаем содержимое между тегами
                    let innerContent;
                    if (result) {
                        innerContent = result.map((match) => {
                            return match.replace(
                                /<div class="example_card_down">|<\/div>/g,
                                ""
                            );
                        });

                        console.log("inner", innerContent);
                    }

                    var newContent = innerContent;
                    console.log("new", newContent);

                    editor.selection.setContent(newContent, {
                        format: "html",
                    });
                    isExampleActive = false;
                    editor.ui.registry.get("example").icon = "";
                } else {
                    // Добавляем класс, если его нет
                    let newContent =
                        '<p class="text3"><br></p>' +
                        '<div class="example_card">' +
                        '<div class="example_card_top">' +
                        '<p class="text2" contenteditable="false">Примеры</p>' +
                        "</div>" +
                        '<div class="example_card_down">' +
                        '<p class="text3">' +
                        selectedContent +
                        "</p>" +
                        "</div>" +
                        "</div>" +
                        '<p class="text3"><br></p>';
                    editor.selection.setContent(newContent, {
                        format: "html",
                    });
                    isExampleActive = true;
                    editor.ui.registry.get("example").icon = "checkmark";
                }
            },
        });

        // var isProcessing = false;
        // editor.on('NodeChange', function () {
        //     if (!isProcessing) {
        //         isProcessing = true;

        //         var images = editor.dom.select('img');
        //         images.forEach(function (image) {
        //             console.log("image");
        //             // если у родителя нет такого класса
        //             if (!image.parentNode.contains('img_place')) {
        //                 console.log("not have");
        //                 var div = editor.dom.create('div', { class: 'img_place' }); //создать такого родителя

        //                 image.parentNode.insertBefore(div, image); //поместить изображение в родителя
        //                 div.appendChild(image);
        //             }

        //         });

        //         isProcessing = false;
        //     }
        // });

        var isProcessing = false;
        editor.on("NodeChange", function () {
            if (!isProcessing) {
                isProcessing = true;

                var images = editor.dom.select("img");
                images.forEach(function (image) {
                    console.log("image");
                    // проверка наличия у родителя класса 'img_place'
                    if (!image.parentNode.classList.contains("img_place")) {
                        console.log("not have");
                        var div = editor.dom.create("div", {
                            class: "img_place",
                        }); // создать родительский div

                        image.parentNode.insertBefore(div, image); // поместить изображение в новый родительский div
                        div.appendChild(image);
                    }
                });

                isProcessing = false;
            }
        });

        editor.on("change", function () {
            // При изменении в редакторе
            const content = editor.getContent({
                format: "text",
            }); // Получаем содержимое редактора
            let second_add_step = document.querySelector("#second_add_step");

            if (content.trim() !== "") {
                console.log("Текст присутствует в редакторе");
                second_add_step.disabled = false;
                document
                    .querySelector("#add_step_2")
                    .classList.add("add_step_active");
            } else {
                console.log("Редактор пуст");
                second_add_step.disabled = true;
                document
                    .querySelector("#add_step_2")
                    .classList.remove("add_step_active");
            }
        });
    },
});

document
    .getElementById("second_add_step")
    .addEventListener("click", function () {
        var content = tinymce.activeEditor.getContent();

        var data = {
            content: content,
        };

        console.log("lesson", data);
        var jsonData = JSON.stringify(data);
        // Сохранение в локальное хранилище
        localStorage.setItem("myData", jsonData);
    });

// Вызов функции для обработки абзацев
editor.processParagraphs();
