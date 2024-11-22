<?php
session_start();

 
$questions = [
    ['id' => 1, 'question' => 'For an advertiser focused on branding, what are the key success metrics on Google Display Network?', 'options' => ['Click Through Rate', 'CPC', 'Reach & Frequency', 'Clicks'], 'answer' => 'Reach & Frequency'],
      ['id' => 2, 'question' => ' Which would contribute to a higher Quality Score for a display ad?', 'options' => ['Higher CPM bid', 'Fast landing page load time', 'How old is the ad', 'Creativity of the ad'], 'answer' => 'Fast landing page load time'],
     ['id' => 3, 'question' => 'If a display ad has been disapproved, how does an advertiser submit a request for another review?','options' => ['Call Google Help', 'Create a new ad group and upload the ad there', 'Save the edited ad or upload a new ad in AdWords', 'Click "Request a Review Again" button'], 'answer' => 'Call Google Help'],
        ['id' => 4, 'question' => ' Ads on YouTube are bought and sold on an auction basis as well as on a reservation basis. What placements on Youtube.lk you can buy ad placements on reservation basis?', 'options' => ['You cant buy reservation based ads on Youtube in Sri Lanka', 'Youtube Masthead Ads', 'Youtube Pre-Roll Ads', 'Youtube Watch Page Ads'], 'answer' => 'Youtube Masthead Ads'],
     ['id' => 5, 'question' => 'In Google Analytics to recognize users across different devices, what is required for User ID?', 'options' => ['Attribution Models', 'Google Ads Linking', 'User ID', 'Audience Definitions'], 'answer' => 'User ID'],
      ['id' => 6, 'question' => 'What Google Analytics report shows the percent of site traffic that visited previously?', 'options' => ['Sales Performance report', 'Frequency & Recency report', 'Referrals report', 'New vs Returning report'], 'answer' => 'New vs Returning report'],
     ['id' => 7, 'question' => 'When will Google Analytics be unable to identify sessions from the same user by default?', 'options' => ['When the sessions happen in the same browser on the same device', 'When the sessions happen in the same browser on the same day', 'When the sessions share the same browser cookie', 'When the sessions happen in different browsers on the same device'], 'answer' => 'When the sessions happen in different browsers on the same device'],
        ['id' => 8, 'question' => 'When does the tracking code send an event hit to Google Analytics?', 'options' => ['Every time a user adds an event to their calendar', 'Every time a user makes a reservation', 'Every time a user performs an action with event tracking implemented', 'Every time a user performs an action with pageview tracking implemented'], 'answer' => 'Every time a user adds an event to their calendar'],
      ['id' => 9, 'question' => ' Which of these is not a Programmatic Media Buying Method?', 'options' => ['Adobe Marketing Cloud', 'Rubicon Project', 'SimillarWeb', 'DoubleClick'], 'answer' => 'SimillarWeb'],
           ['id' => 10, 'question' => 'Which of these is a Social Media Analytics tool?', 'options' => ['Google Analytics', 'Eskimi', 'SocialBakers', 'Social Media Examiner'], 'answer' => 'SocialBakers'],
     
];

 
if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = [];
}
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

 
if (!isset($_SESSION['quiz_start_time'])) {
    $_SESSION['quiz_start_time'] = time();  
}

$total_time_allowed = 600;  
$time_elapsed = time() - $_SESSION['quiz_start_time'];
$time_remaining = $total_time_allowed - $time_elapsed;

if ($time_remaining <= 0) {
    
    header('Location: user_info.php');
    exit;
}

 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_question = $_SESSION['current_question'];

    
    if (isset($_POST['answer'])) {
        $_SESSION['answers'][$current_question] = $_POST['answer'];
    }

     
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'Next') {
            if ($current_question < count($questions) - 1) {
                $_SESSION['current_question']++;
            } elseif ($current_question === count($questions) - 1) {
                
                header('Location: user_info.php');
                exit;
            }
        } elseif ($_POST['action'] === 'Back' && $current_question > 0) {
            $_SESSION['current_question']--;
        }
    }

    
    header('Location: quiz.php');
    exit;
}

 
$current_question = $_SESSION['current_question'];
$question = $questions[$current_question];
$saved_answer = $_SESSION['answers'][$current_question] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .quiz-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .quiz-container h1 {
            text-align: center;
            color: #333;
        }
        .quiz-container h3 {
            margin-bottom: 20px;
            color: #555;
        }
        .quiz-container form {
            display: flex;
            flex-direction: column;
        }
        .quiz-container form input[type="radio"] {
            margin-right: 10px;
        }
        .quiz-container form label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            cursor: pointer;
        }
        .quiz-container .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .quiz-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .quiz-container button:disabled {
            background-color: #ddd;
            color: #aaa;
            cursor: not-allowed;
        }
        .quiz-container button:hover:not(:disabled) {
            background-color: #4CAF50;
            color: white;
        }
        .quiz-container #timer {
            text-align: right;
            font-size: 18px;
            color: #ff5722;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz</h1>
        <div id="timer"><?php echo gmdate("i:s", $time_remaining); ?></div>  
        <p>Question <?php echo $current_question + 1; ?> of <?php echo count($questions); ?></p>
        <form id="quizForm" method="POST" action="quiz.php">
            <h3><?php echo $question['question']; ?></h3>
            <?php foreach ($question['options'] as $option): ?>
                <label>
                    <input type="radio" name="answer" value="<?php echo $option; ?>"
                        <?php echo ($saved_answer === $option) ? 'checked' : ''; ?>>
                    <?php echo $option; ?>
                </label>
                  <?php endforeach; ?>
               <div class="buttons">
                <button type="submit" name="action" value="Back" <?php echo ($current_question === 0) ? 'disabled' : ''; ?>>Back</button>
                <button type="submit" name="action" value="Next">Next</button>
            </div>
        </form>
    </div>
    <script>
     
        let timer = <?php echo $time_remaining; ?>; 
        const interval = setInterval(() => {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            document.getElementById('timer').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (--timer < 0) {
                clearInterval(interval);
                alert("Time's up! Submitting your answers.");
                window.location.href = 'user_info.php';  
            }
        }, 1000);
    </script>
</body>
</html>
