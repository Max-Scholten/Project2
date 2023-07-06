<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

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

$partyId = 1; // Party ID for VVD

// Get the party's positions for the questions
$stmt = $conn->prepare("SELECT partyquestions.agrees FROM partyquestions
                        INNER JOIN questions ON partyquestions.questionId = questions.questionId
                        WHERE partyquestions.partyId = :partyId");
$stmt->bindParam(':partyId', $partyId);
$stmt->execute();
$partyPositions = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get user's answers for the questions
$stmt = $conn->prepare("SELECT userquestions.agrees FROM userquestions
                        INNER JOIN questions ON userquestions.questionId = questions.questionId
                        WHERE userquestions.userId = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$userAnswers = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Calculate the total points of agreement
$totalQuestions = count($partyPositions);
$totalPoints = 0;

for ($i = 0; $i < $totalQuestions; $i++) {
    if ($userAnswers[$i] == $partyPositions[$i]) {
        $totalPoints++;
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <p>Total Points: <?php echo $totalPoints; ?></p>
</body>
</html>
