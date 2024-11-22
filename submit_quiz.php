<?php
session_start();
$questions = [
   
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = $_POST['answer'];
    $question = $questions[$_SESSION['current_question']];
    $_SESSION['score'] = $_SESSION['score'] ?? 0;

    if ($answer === $question['answer']) {
        $_SESSION['score'] += 5;
    }

    $_SESSION['current_question']++;
    header('Location: quiz.php');
    exit;
}
?>
