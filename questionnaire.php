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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $questionId => $answer) {
        $agree = ($answer === 'yes') ? 1 : 0;
        $sql = "INSERT INTO userquestions (userId, questionId, agrees) VALUES ($userId, $questionId, $agree)";
        $conn->query($sql);
    }

    $conn->close();
    header("Location: results.php");
    exit();
}

$sql = "SELECT * FROM questions";
$results = $conn->query($sql);
$questions = [];

if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Questionnaire</title>
    <link rel="stylesheet" href="../Project2/css/question.css">
</head>
<body>
    <h2>Questionnaire</h2>
    <form method="POST" action="">
        <?php foreach ($questions as $question) : ?>
            <div>
                <p><?php echo $question['text']; ?></p>
                <input type="radio" id="yes" name="<?php echo $question['questionId']; ?>" value="yes" required>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="<?php echo $question['questionId']; ?>" value="no" required>
                <label for="no">No</label>
            </div>
        <?php endforeach; ?>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
    <script>
        document.querySelector("form").addEventListener("submit", function() {
            document.querySelector("button[type='submit']").disabled = true;
        });
    </script>
</body>
</html>
