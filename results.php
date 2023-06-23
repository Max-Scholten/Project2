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

$stmt = $conn->prepare("SELECT parties.name, SUM(userquestions.agrees) AS score
        FROM parties
        INNER JOIN partyquestions ON parties.partyId = partyquestions.partyId
        INNER JOIN userquestions ON partyquestions.questionId = userquestions.questionId
        WHERE userquestions.userId = :userId
        GROUP BY parties.partyId
        ORDER BY score DESC");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$parties = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPoints = 0;
$userParty = '';

foreach ($parties as $party) {
    if ($userParty === '') {
        $userParty = $party['name'];
    } elseif ($party['score'] === $totalPoints) {
        $userParty = 'None'; // User has equal points with multiple parties
    }

    $totalPoints += $party['score'];
}

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="../Project2/css/results.css">
</head>
<body>
    <header>Results</header>
    <p>Username: <?php echo $_SESSION['username']; ?></p>
    <p>Total Points: <?php echo $totalPoints; ?></p>
    <p>Your Political Leaning: <?php echo ($userParty === 'None') ? 'Indeterminate' : $userParty; ?></p>

    <?php if ($userParty === 'None') : ?>
        <p>Since you have equal points with multiple parties, please answer the following question to determine your political leaning:</p>
        <form method="POST" action="questionnaire.php">
            <div>
                <p>Additional Question:</p>
                <input type="radio" id="yes" name="additionalQuestion" value="yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="additionalQuestion" value="no" required>
                <label for="no">No</label>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
