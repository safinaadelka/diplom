const questionText = document.getElementById("question-text");
const answerButtons = document.querySelectorAll(".answer-button");
const currentQuestionNumber = document.getElementById("current-question");
const nextQuestionButton = document.getElementById("next-question");
const prevQuestionButton = document.getElementById("prev-question");
const resultsButton = document.getElementById("results-button");
const resultsContainer = document.getElementById("results");
const resultsList = document.getElementById("results-list");

// ... (все остальные элементы, как было)
const startTestButton = document.getElementById("start-test-button");
const startTestButtonAgain = document.getElementById("start-test-button-again");
const testContainer = document.querySelector(".test-container");
const welcomeContainer = document.querySelector(".welcome");

// Текущий вопрос
let currentQuestion = 1;

let questionIndex = 1;
// Массив выбранных ответов
let selectedAnswers = [];
// Массив с правильными ответами
const questions = [
    {
        question_text: 'Какой из перечисленных вариантов правильно переводит фразу "Je vais à la bibliothèque"?',
        level: 1,
        category: "Basic",
        answers: [
            {
                id: 1,
                answer_text:
                    "Я иду в магазин.",
                is_correct: false,
            }, // Добавили id
            { id: 2, answer_text: "Я иду в кино", is_correct: false }, // Добавили id
            { id: 3, answer_text: "Я иду в библиотеку", is_correct: true }, // Добавили id
            { id: 4, answer_text: "Я иду в парк", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно дополнить предложение: "Hier, je _ au cinéma avec mes amis"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "allais", is_correct: false }, // Добавили id
            { id: 2, answer_text: "suis allé", is_correct: true }, // Добавили id
            { id: 3, answer_text: "va", is_correct: false }, // Добавили id
            { id: 4, answer_text: "irai", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Какой из перечисленных вариантов правильно использует глагол "devoir" в предложении?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "Je dois manger maintenant", is_correct: true }, // Добавили id
            { id: 2, answer_text: "Je devoir manger maintenant.", is_correct: false }, // Добавили id
            { id: 3, answer_text: "Je doit manger maintenant.", is_correct: false }, // Добавили id
            { id: 4, answer_text: "Je doive manger maintenant.", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно перевести фразу "Il est important que tu fasses tes devoirs"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "Важно, чтобы вы делали домашнее задание.", is_correct: true }, // Добавили id
            { id: 2, answer_text: "Важно, чтобы ты сделал домашнее задание.", is_correct: false }, // Добавили id
            { id: 3, answer_text: "Важно, чтобы ты сделал домашнее задание в будущем.", is_correct: false }, // Добавили id
            { id: 4, answer_text: "Важно, чтобы ты обязан домашнее задание.", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно дополнить предложение: "Elle m\'a dit qu\'elle _ en France l\'année prochaine"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "a allé", is_correct: false }, // Добавили id
            { id: 2, answer_text: "ira", is_correct: true }, // Добавили id
            { id: 3, answer_text: "est allée", is_correct: false }, // Добавили id
            { id: 4, answer_text: "va", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Какой из перечисленных вариантов правильно переводит слово "souligner"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "вычеркнуть", is_correct: false }, // Добавили id
            { id: 2, answer_text: "кружить", is_correct: false }, // Добавили id
            { id: 3, answer_text: "выделить", is_correct: false }, // Добавили id
            { id: 4, answer_text: "подчеркнуть", is_correct: true }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно дополнить предложение: "Si j\'avais su, je _ pas venu"?',
        level: 1,
        category: "Basic",
        answers: [
            {
                id: 1,
                answer_text:
                    "était",
                is_correct: false,
            }, // Добавили id
            { id: 2, answer_text: "étais", is_correct: false }, // Добавили id
            { id: 3, answer_text: "serais", is_correct: true }, // Добавили id
            { id: 4, answer_text: "suis", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Какой из вариантов правильно использует местоимение "leur" в предложении?',
        level: 1,
        category: "Basic",
        answers: [
            {
                id: 1,
                answer_text:
                    " Je ai donné les livres à elles.",
                is_correct: false,
            }, // Добавили id
            { id: 2, answer_text: "Je ai donné les livres à eux.", is_correct: false }, // Добавили id
            { id: 3, answer_text: "Je leur ai donné les livres.", is_correct: true }, // Добавили id
            { id: 4, answer_text: "Je les ai donné les livres.", is_correct: false }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно перевести фразу "Je ne sais pas à qui cela appartient"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "I don't know when it belongs to.", is_correct: false }, // Добавили id
            { id: 2, answer_text: "I don't know where it belongs to.", is_correct: false }, // Добавили id
            { id: 3, answer_text: "I don't know what it belongs to", is_correct: false }, // Добавили id
            { id: 4, answer_text: "I don't know who it belongs to", is_correct: true }, // Добавили id
        ],
    },
    {
        question_text: 'Как правильно дополнить предложение: "Il est important _ nous parlions avec respect"?',
        level: 1,
        category: "Basic",
        answers: [
            { id: 1, answer_text: "pour", is_correct: false }, // Добавили id
            { id: 2, answer_text: "que", is_correct: true }, // Добавили id
            { id: 3, answer_text: "de", is_correct: false }, // Добавили id
            { id: 4, answer_text: "à", is_correct: false }, // Добавили id
        ],
    },
];

// Массив правильных ответов (для проверки результатов)
let correctAnswers = [];
// Отображение вопроса

function displayQuestion(questionIndex) {
    const question = questions[questionIndex - 1];
    questionText.textContent = question.question_text;
    question.answers.forEach((answer, index) => {
        const button = answerButtons[index];
        console.log(button);
        const checkbox = button.querySelector(".checkbox"); // Get the button element

        if (
            parseInt(button.dataset.answerId, 10) ==
            selectedAnswers[questionIndex - 1]
        ) {
            const answerFucks = button.parentNode.querySelectorAll(".checkbox");
            answerFucks.forEach((answerFuck) => {
                if (answerFuck.classList.contains("checkbox_active")) {
                    answerFuck.classList.remove("checkbox_active");
                }
            });

            checkbox.classList.add("checkbox_active");
            console.log("GHJIOKdjslkj");
        } else if (selectedAnswers[questionIndex - 1] === undefined) {
            const answerFucks = button.parentNode.querySelectorAll(".checkbox");
            answerFucks.forEach((answerFuck) => {
                if (answerFuck.classList.contains("checkbox_active")) {
                    answerFuck.classList.remove("checkbox_active");
                }
            });
        }

        console.log("dddd", parseInt(button.dataset.answerId, 10));
        console.log(selectedAnswers[questionIndex - 1]);

        buttonText = button.querySelector("p");
        buttonText.textContent = answer.answer_text;

        button.dataset.answerId = answer.id; // Теперь используем answer.id
    });
    currentQuestionNumber.textContent = questionIndex;
    // Очистка выбранного ответа
    if (questionIndex <= selectedAnswers.length) {
        // selectedAnswers[questionIndex - 1] = undefined;
        // console.log("очистили");
    }
}

// Обработчик выбора ответа
function handleAnswerClick(event) {
    const button = event.target.parentNode;
    console.log(button);
    const selectedAnswerId = parseInt(button.dataset.answerId, 10); // Преобразуем строку в число
    console.log("selectedAnswerId", selectedAnswerId);

    const checkbox = button.querySelector(".checkbox"); // Get the button element

    const answerFucks = button.parentNode.querySelectorAll(".checkbox");
    answerFucks.forEach((answerFuck) => {
        if (answerFuck.classList.contains("checkbox_active")) {
            answerFuck.classList.remove("checkbox_active");
        }
    });

    console.log(answerButtons);

    console.log(checkbox);
    checkbox.textContent = "✔";
    checkbox.classList.add("checkbox_active");
    // const questionIndex = parseInt(
    //     event.target.parentElement.dataset.questionIndex,
    //     10
    // );

    console.log("questionIndex", questionIndex);
    // Записываем выбранный ответ
    selectedAnswers[questionIndex - 1] = selectedAnswerId;
    console.log(selectedAnswers);
    // Переход к следующему вопросу

    if (questionIndex !== 1) {
        prevQuestionButton.disabled = false;
    }

    if (questionIndex == questions.length) {
        nextQuestionButton.disabled = true;
        nextQuestionButton.style.display = "none";
    } else {
        nextQuestionButton.disabled = false;
        nextQuestionButton.style.display = "flex";
    }

    if (selectedAnswers.every((answer) => answer !== undefined)) {
        if (selectedAnswers.length === questions.length) {
            resultsButton.disabled = false; // Кнопка результата доступна
            resultsButton.style.display = "flex";
        }
    }
}

// Переход к следующему вопросу
function nextQuestion() {
    questionIndex++;
    console.log("questionIndex", questionIndex);
    if (currentQuestion < questions.length) {
        console.log(currentQuestion);
        console.log(selectedAnswers[currentQuestion - 1]);
        if (selectedAnswers[currentQuestion - 1] !== undefined) {
            currentQuestion++;

            displayQuestion(currentQuestion); // Отображение следующего вопроса
        } else {
            alert("Пожалуйста, выберите ответ на текущий вопрос."); // Сообщение об ошибке
        }
    }

    if (questionIndex == questions.length) {
        nextQuestionButton.disabled = true;
        nextQuestionButton.style.display = "none";
    } else {
        nextQuestionButton.disabled = false;
        nextQuestionButton.style.display = "flex";
    }
}

// Обработчик кнопки "Узнать результаты"

// Обработчик кнопки "Начать тест"
function startTest() {
    welcomeContainer.style.display = "none";
    testContainer.style.display = "flex";
    resultsContainer.style.display = "none";
    selectedAnswers = [];
    displayQuestion(1); // Отображаем первый вопрос
    loadQuestions();
}
// Обработчики событий
answerButtons.forEach((button) =>
    button.addEventListener("click", handleAnswerClick)
);
nextQuestionButton.addEventListener("click", nextQuestion);
prevQuestionButton.addEventListener("click", prevQuestion);
resultsButton.addEventListener("click", showResults);
startTestButtonAgain.addEventListener("click", function(){
    location.reload(); 
    startTest(); 
}
);
startTestButton.addEventListener("click", startTest);

function loadQuestions() {
    questions.forEach((question) => {
        // Используем findIndex для поиска ответа, который is_correct
        const correctAnswerIndex = question.answers.findIndex(
            (answer) => answer.is_correct
        );
        console.log(correctAnswerIndex);
        if (correctAnswerIndex !== -1) {
            console.log("прав_ответ");
            // Проверяем, найден ли правильный ответ
            correctAnswers.push(question.answers[correctAnswerIndex].id); // Добавляем ID
        }
    });
}

function showResults() {
    console.log(correctAnswers);

    resultsContainer.style.display = "flex";
    testContainer.style.display = "none";
    resultsList.innerHTML = ""; // Очищаем список результатов

    const user_level = document.querySelector("#user_level");
    const level_kurs = document.querySelector("#level_kurs"); 
    let rightAnswers = 0;
    // Проходим по вопросам и отображаем результаты
    for (let i = 0; i < questions.length; i++) {
        const question = questions[i];
        const selectedAnswerId = parseInt(selectedAnswers[i], 10);
        console.log(selectedAnswerId);

        const correctAnswerId = correctAnswers[i];
        const answers = question.answers;
        const listItem = document.createElement("li");

        // Отображение вопроса
        listItem.innerHTML = `<p class="text2">${i + 1}. ${
            question.question_text
        }</p>`;

        // Отображение выбранного ответа
        const chosenAnswer = answers.find(
            (answer) => answer.id === selectedAnswerId
        );

        // Отображение правильного ответа
        const correctAnswer = answers.find(
            (answer) => answer.id === correctAnswerId
        );
        if (selectedAnswerId === correctAnswerId) {
            listItem.innerHTML += `<p class="correct-answer text3">Выбрано верно: ${correctAnswer.answer_text}</p>`;
            rightAnswers++; 
        } else {
            listItem.innerHTML += `<p class="wrong-answer text3">Вы выбрали: ${chosenAnswer.answer_text} </p> <p class="correct-answer text2_reg">  Верный ответ: ${correctAnswer.answer_text}</p>`;
        }

        resultsList.appendChild(listItem);
    }

    rightAnswersProcent = (rightAnswers / selectedAnswers.length) * 100; 
    if(rightAnswersProcent >= 0 && rightAnswersProcent < 50){
        user_level.innerHTML = 'A1. Начальный уровень'; 
        level_kurs.innerHTML = 'Курс для новичков'; 
        level_kurs.href = '/modul/1'; 

    }
    if(rightAnswersProcent >= 50 && rightAnswersProcent < 100){
        user_level.innerHTML = 'А2. Ниже среднего'; 
        level_kurs.innerHTML = 'Курс для продолжающих'; 
        level_kurs.href = '/modul/2'; 
    }
}

// Переход к предыдущему вопросу
function prevQuestion() {
    if (currentQuestion > 1) {
        currentQuestion--;
        questionIndex--;
        displayQuestion(currentQuestion);
    }

    if (currentQuestion === 1) {
        prevQuestionButton.disabled = true;
    } else {
        prevQuestionButton.disabled = false;
    }

    if (questionIndex == questions.length) {
        nextQuestionButton.disabled = true;
        nextQuestionButton.style.display = "none";
    } else {
        nextQuestionButton.disabled = false;
        nextQuestionButton.style.display = "flex";
    }
}
