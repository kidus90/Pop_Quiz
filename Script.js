let questions = [];
let currentQuestionIndex = 0;

function loadQuestion() {
    if (questions.length === 0) return;
    const questionElement = document.getElementById("question");
    questionElement.textContent = questions[currentQuestionIndex].question;
    document.getElementById(`finish-container`).style.display = "none";
    document.getElementById(`center-container`).style.display = "flex";

    for (let i = 0; i < 4; i++) {
        const btn = document.getElementById(`answer${i + 1}`);
        document.getElementById(`answer${i + 1}`).style.backgroundColor = "#d1d7d1";
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

// Fetch questions from JSON file
fetch('questions.json')
    .then(response => response.json())
    .then(data => {
        questions = data;
        loadQuestion();
    })
    .catch(error => {
        console.error('Error loading questions:', error);
    });