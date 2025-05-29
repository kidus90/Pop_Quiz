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
        if (
                isset($_GET['question']) &&
                isset($_GET['answer1']) &&
                isset($_GET['answer2']) &&
                isset($_GET['answer3']) &&
                isset($_GET['answer4']) &&
                isset($_GET['correct-answer'])
            ) {
            $questionData = [
                "question" => $_GET['form_question'],
                "answers" => [
                    $_GET['form_answer1'],
                    $_GET['form_answer2'],
                    $_GET['form_answer3'],
                    $_GET['form_answer4']
                ],
                "correct" => intval($_GET['form_correct-answer'])
            ];

            $file = 'questions.json';
            if (file_exists($file)) {
                $json = file_get_contents($file);
                $questions = json_decode($json, true);
                if (!is_array($questions)) {
                    $questions = [];
                }
            } else {
                $questions = [];
            }
            $questions[] = $questionData;
            file_put_contents($file, json_encode($questions, JSON_PRETTY_PRINT));
            echo "<p style='color:green;'>Question added successfully!</p>";
        }
    ?>
    
    <div id="center-container">
        
        <h1>Welcome to the Pop Quiz</h1>
        <div id="quiz-container">
            
            <div class="form_question">
                <form id="Quiz-Question" method="GET">
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

                    <label for="correct-answer">Correct Answer:</label>
                    <input type="number" id="id_correct-answer" name="form_correct-answer" required><br>
                    
                    <button type="submit">Submit Question</button>
                </form>
            </div>

            <div id="quiz">
                <p id="Title"><b>Warm Up Before Study</b></p>
                <hr>
                <div id="question-container">
                    <br>
                    <p id="question">Question text will go here</p>
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