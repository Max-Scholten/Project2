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
    <?php if (!empty($parties)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Party</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parties as $party) : ?>
                    <tr>
                        <td><?php echo $party['name']; ?></td>
                        <td><?php echo $party['score']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No parties found.</p>
    <?php endif; ?>
</body>
</html>
