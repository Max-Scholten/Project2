<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'stemwijzer';

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$username = $_GET['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $row['userId'];

    // Delete associated records in the userquestions table
    $stmtDeleteQuestions = $conn->prepare("DELETE FROM userquestions WHERE userId = :userId");
    $stmtDeleteQuestions->bindParam(':userId', $userId);
    if (!$stmtDeleteQuestions->execute()) {
        $errorMessage = "Error deleting associated answers: " . $stmtDeleteQuestions->errorInfo()[2];
    } else {
        // Delete the user
        $stmtDeleteUser = $conn->prepare("DELETE FROM users WHERE userId = :userId");
        $stmtDeleteUser->bindParam(':userId', $userId);
        if ($stmtDeleteUser->execute()) {
            session_destroy(); // Clear the session data
            header("Location: login.php"); // Redirect to the login page
            exit();
        } else {
            $errorMessage = "Error deleting account: " . $stmtDeleteUser->errorInfo()[2];
        }
    }
} else {
    $errorMessage = "Invalid username";
}

$conn = null;
?>
