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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $questionId => $answer) {
        $agree = ($answer === 'yes') ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO userquestions (userId, questionId, agrees) VALUES (:userId, :questionId, :agree)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':questionId', $questionId);
        $stmt->bindParam(':agree', $agree);
        $stmt->execute();
    }

    $conn = null;
    header("Location: results.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM questions");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Questionnaire</title>
    <link rel="stylesheet" href="../Project2/css/question.css">
</head>
<body>
    <header>Questionnaire</header>
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
<footer></footer>
</html>
