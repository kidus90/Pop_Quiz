const questions = [
    {
        question: "What is the capital of France?",
        answers: ["Berlin", "Madrid", "Paris", "Lisbon"],
        correct: 2
    },
    {
        question: "What is 2 + 2?",
        answers: ["3", "4", "5", "6"],
        correct: 1
    },
    {
        question: "What is the largest planet in our solar system?",
        answers: ["Earth", "Mars", "Jupiter", "Saturn"],
        correct: 2
    },
    {
        question: "Who wrote 'Romeo and Juliet'?",
        answers: ["Mark Twain", "Charles Dickens", "William Shakespeare", "Jane Austen"],
        correct: 2
    }
];

let currentQuestionIndex = 0;

function loadQuestion() {
    const questionElement = document.getElementById("question");
    questionElement.textContent = questions[currentQuestionIndex].question;
    document.getElementById(`finish-container`).style.display = "none";
    document.getElementById(`center-container`).style.display = "flex";


    document.getElementById(`answer${1}`).style.backgroundColor = "#d1d7d1";
    document.getElementById(`answer${2}`).style.backgroundColor = "#d1d7d1";
    document.getElementById(`answer${3}`).style.backgroundColor = "#d1d7d1";
    document.getElementById(`answer${4}`).style.backgroundColor = "#d1d7d1";
    for (let i = 0; i < 4; i++) {
        const btn = document.getElementById(`answer${i + 1}`);
        if (btn) {
            btn.textContent = questions[currentQuestionIndex].answers[i];
        }
    }
}

function selectAnswer(selectedIndex) {
    const correctIndex = questions[currentQuestionIndex].correct;
    if (selectedIndex === correctIndex) {
        const correctbtn = document.getElementById(`answer${selectedIndex + 1}`);
        correctbtn.style.backgroundColor = "green";
        setTimeout(nextQuestion, 1000);
    } else {
        const incorrectbtn = document.getElementById(`answer${selectedIndex + 1}`);
        incorrectbtn.style.backgroundColor = "red";
    }
}

function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        loadQuestion();
    } else {
        currentQuestionIndex = 0;
        document.getElementById(`finish-container`).style.display = "flex";
        document.getElementById(`center-container`).style.display = "none";
    }
}

loadQuestion();