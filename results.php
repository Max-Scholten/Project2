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

$stmt = $conn->prepare("SELECT parties.name, COUNT(*) AS score
        FROM parties
        INNER JOIN partyquestions ON parties.partyId = partyquestions.partyId
        INNER JOIN userquestions ON partyquestions.questionId = userquestions.questionId
        WHERE userquestions.userId = :userId AND userquestions.agrees = 1
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

    $totalPoints += 1; // Count only one point for each "Yes" answer
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
    <h2>Results</h2>
    <p>Username: <?php echo $_SESSION['username']; ?></p>
    <p>Total Points: <?php echo $totalPoints; ?></p>
    <p>Your Political Leaning: <?php if ($totalPoints <= 5) : ?>
        <p>Based on your points, we recommend you vote for D66.</p>
    <?php elseif ($totalPoints >= 6 && $totalPoints <= 10) : ?>
        <p>Based on your points, we recommend you vote for <?php echo ($userParty === 'VVD') ? 'VVD' : 'SP'; ?>.</p>
    <?php endif; ?></p>

   

    <a href="login.php">Log In</a>
</body>
</html>
