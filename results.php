<?php
session_start();
require 'db.php';  
 
$questions = [
         ['id' => 1, 'answer' => 'Reach & Frequency'],
      ['id' => 2, 'answer' => 'Fast landing page load time'],
       ['id' => 3, 'answer' => 'Call Google Help'],
       ['id' => 4, 'answer' => 'Youtube Masthead Ads'],
       ['id' => 5, 'answer' => 'User ID'],
     ['id' => 6, 'answer' => 'New vs Returning report'],
      ['id' => 7, 'answer' => 'When the sessions happen in different browsers on the same device'],
     ['id' => 8, 'answer' => 'Every time a user adds an event to their calendar'],
      ['id' => 9, 'answer' => 'SimillarWeb'],
     ['id' => 10, 'answer' => 'SocialBakers'],
];

 
$score = 0;
$total_questions = count($questions);
$max_score = $total_questions * 5;  

 
if (isset($_SESSION['answers'])) {
    foreach ($questions as $index => $question) {
         
        if (array_key_exists($index, $_SESSION['answers']) && $_SESSION['answers'][$index] === $question['answer']) {
            $score += 5;  
        }
    }
}

 
$skill_score = ($max_score > 0) ? ($score / $max_score) * 100 : 0;

 
if ($skill_score < 50) {
    $skill_level = "Digital Marketing Novice";
} elseif ($skill_score <= 60) {
    $skill_level = "Digital Marketing Seed";
} elseif ($skill_score <= 70) {
    $skill_level = "Digital Marketing Rising Star";
} elseif ($skill_score <= 80) {
    $skill_level = "Digital Marketing Star";
} else {
    $skill_level = "Digital Marketing Rock Star";
}
$name = $_SESSION['name'] ?? 'Anonymous';
$email = $_SESSION['email'] ?? 'unknown@example.com';

 
try {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, score, skill_level) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $score, $skill_level]);
    $success_message = "Your results have been saved successfully!";
} catch (PDOException $e) {
    $error_message = "Error saving your results: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .result-box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        .result-box h2 {
            color: #4CAF50;
        }
        .result-box p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="result-box">
        <h1>Your Quiz Results</h1>
        <h2>Skill Level: <?php echo $skill_level; ?></h2>
        <p><strong>Score:</strong> <?php echo $score; ?> out of <?php echo $max_score; ?></p>
        <p><strong>Skill Score:</strong> <?php echo $skill_score; ?>%</p>
        <?php if (isset($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
