 
CREATE DATABASE IF NOT EXISTS quiz_app;

 
USE quiz_app;

 
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    name VARCHAR(100) NOT NULL,                
    email VARCHAR(100) NOT NULL UNIQUE,        
    score INT NOT NULL,                       
    skill_level VARCHAR(50) NOT NULL,         
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
);

 
INSERT INTO users (name, email, score, skill_level) 
VALUES 
('John Doe', 'john.doe@example.com', 40, 'Digital Marketing Rising Star'),
('Jane Smith', 'jane.smith@example.com', 50, 'Digital Marketing Rock Star');
