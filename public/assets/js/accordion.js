const questions = document.querySelectorAll('.question');

questions.forEach((question) => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        const toggle = question.querySelector('.black_arrow');

        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            toggle.style.transform = `rotate(-45deg)`;
            toggle.textContent = '+';
        } else {
            answer.style.maxHeight = answer.scrollHeight + 'px';
            toggle.textContent = '×';
            toggle.style.transform = `rotate(45deg)`;
        }
    });
});