<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_SESSION['name'] = $_POST['name'] ?? 'Anonymous';
    $_SESSION['email'] = $_POST['email'] ?? 'unknown@example.com';

     
    header('Location: results.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Enter Your Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Complete Your Profile</h1>
    <form method="POST" action="user_info.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
