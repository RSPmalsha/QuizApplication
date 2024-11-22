<?php
session_start();
$_SESSION['current_question'] = 0;
$_SESSION['score'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to the Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Quiz</h1>
    <p>Click the button below to start your quiz!</p>
    <form action="quiz.php" method="GET">
        <button type="submit">Start Quiz</button>
    </form>
</body>
</html>
