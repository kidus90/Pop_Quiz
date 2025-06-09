<?php
if (isset($_GET['get_questions'])) {
    header('Content-Type: application/json');
    $mysqli = new mysqli('localhost', 'root', '', 'pop_quiz');
    $result = $mysqli->query('SELECT * FROM questions');
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            'question' => $row['question'],
            'answers' => [
                $row['answer1'],
                $row['answer2'],
                $row['answer3'],
                $row['answer4']
            ],
            'correct' => intval($row['correct_answer']) - 1 
        ];
    }
    echo json_encode($questions);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>question preparation</title>
    <link rel="stylesheet" href="Style.css">
    <script src="Script.js" defer></script>
</head>

<body>
    <?php
    // Connect to MySQL and ensure DB/table exist only once for the main page
    $mysqli = new mysqli('localhost', 'root', '', '');
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    $mysqli->query("CREATE DATABASE IF NOT EXISTS pop_quiz");
    $mysqli->query("USE pop_quiz");
    $mysqli->query("
        CREATE TABLE IF NOT EXISTS questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question TEXT NOT NULL,
            answer1 VARCHAR(255) NOT NULL,
            answer2 VARCHAR(255) NOT NULL,
            answer3 VARCHAR(255) NOT NULL,
            answer4 VARCHAR(255) NOT NULL,
            correct_answer INT NOT NULL
        )
    ");

    if (
        isset($_GET['form_question']) &&
        isset($_GET['form_answer1']) &&
        isset($_GET['form_answer2']) &&
        isset($_GET['form_answer3']) &&
        isset($_GET['form_answer4']) &&
        isset($_GET['form_correct-answer'])
    ) {
        $question = $mysqli->real_escape_string($_GET['form_question']);
        $answer1 = $mysqli->real_escape_string($_GET['form_answer1']);
        $answer2 = $mysqli->real_escape_string($_GET['form_answer2']);
        $answer3 = $mysqli->real_escape_string($_GET['form_answer3']);
        $answer4 = $mysqli->real_escape_string($_GET['form_answer4']);
        $correct = intval($_GET['form_correct-answer']);

        $sql = "INSERT INTO questions (question, answer1, answer2, answer3, answer4, correct_answer)
                VALUES ('$question', '$answer1', '$answer2', '$answer3', '$answer4', $correct)";
        $mysqli->query($sql);
    }
    ?>

    <div id="center-container">

        <h1>Welcome to the Pop Quiz</h1>
        <div id="quiz-container">

            <div class="form_question">
                <form id="Quiz-Question" method="GET">
                    <button type="button" class="back-btn" onclick="Back()">&#8592;Back</button>
                    <label for="question">Question:</label>
                    <input type="text" id="question" name="form_question" required><br>

                    <label for="answer1">Answer 1:</label>
                    <input type="text" id="id_answer1" name="form_answer1" required><br>

                    <label for="answer2">Answer 2:</label>
                    <input type="text" id="id_answer2" name="form_answer2" required><br>

                    <label for="answer3">Answer 3:</label>
                    <input type="text" id="id_answer3" name="form_answer3" required><br>

                    <label for="answer4">Answer 4:</label>
                    <input type="text" id="id_answer4" name="form_answer4" required><br>

                    <label for="correct-answer">Correct Answer Number:</label>
                    <input type="number" id="id_correct-answer" name="form_correct-answer" required><br>

                    <button type="submit">Submit Question</button>
                </form>
            </div>

            <div id="quiz">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p id="Title"><b>Warm Up Before Study</b></p>
                    <button class="add" type="button" onclick="showFormQuestion()" style="border: none; border-radius: 5px; padding: 12px 12px; cursor: pointer; margin-bottom: 4px">➕</button>
                </div>
                <hr>
                <div id="question-container">
                    <br>
                    <p id="text_question">Question text will go here</p>
                    <div id="answers" class="btn-container">
                        <button id="answer1" class="btn" onclick="selectAnswer(0)">Answer 1</button>
                        <button id="answer2" class="btn" onclick="selectAnswer(1)">Answer 2</button>
                        <button id="answer3" class="btn" onclick="selectAnswer(2)">Answer 3</button>
                        <button id="answer4" class="btn" onclick="selectAnswer(3)">Answer 4</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <span style="font-size:20px; color: Red; display: flex; justify-content: center;">Notice!!! after one click wait for 2 seconds to get the next question</span>
    </div>
    <div id="finish-container">
        <div class="hidden">
            <h2>🎊Congrats on completing the quiz!🎊</h2>
            <br>
            <p id="score"><br>
                You did great—keep striving for more!<br>
                Every step you take in learning brings you closer to<br>
                mastering new skills and unlocking future success.<br>
                🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉</p><br>
            <button id="restart-button" class="btn1" onclick="loadQuestion()">Restart Quiz</button>
        </div>
    </div>
</body>

</html>