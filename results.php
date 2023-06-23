<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

$hostname = 'localhost'; // Change this to your database server hostname
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password
$database = 'stemwijzer'; // Change this to your database name

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT parties.name, SUM(userquestions.agrees) AS score
        FROM parties
        INNER JOIN partyquestions ON parties.partyId = partyquestions.partyId
        INNER JOIN userquestions ON partyquestions.questionId = userquestions.questionId
        WHERE userquestions.userId = $userId
        GROUP BY parties.partyId
        ORDER BY score DESC";
$result = $conn->query($sql);
$parties = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parties[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
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
