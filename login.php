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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['userId'] = $row['userId'];
            header("Location: questionnaire.php");
            exit();
        } else {
            $errorMessage = "Invalid username or password";
        }
    } elseif (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $successMessage = "User registered successfully. Please login.";
        } else {
            $errorMessage = "Error registering user: " . $stmt->errorInfo()[2];
        }
    }
    elseif (isset($_POST['delete'])) {
        // Account deletion functionality
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
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
            $errorMessage = "Invalid username or password";
        }
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <link rel="stylesheet" href="../Project2/css/login.css">
    <script src="../Project2/js/iets.js" defer></script>
</head>

<body onload="startTime()">
    <header>Home</header>

    <div id="formi">
        <form method="POST" action="">
            <h2>Login</h2>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button id="login" type="submit" name="login">Login</button>
                <button id="register" type="submit" name="register">Register</button>
                <button id="delete" type="submit" name="delete">Delete Account</button>
            </div>
        </form>
        <?php if (isset($errorMessage)) : ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <?php if (isset($successMessage)) : ?>
            <p><?php echo $successMessage; ?></p>
        <?php endif; ?>
    </div>

    <div id="tekst">
        <p>Dit is een stemwijzer. Je krijgt tien vragen gesteld, waar je ja of nee op moet beantwoorden. De partijen die wij gebruiken zijn de VVD, D66 en de SP, omdat het om de functionaliteit gaat en niet om de grootte.</p>
        <br>
        <p>Zodra je er klaar voor bent, log je in en maak je de vragen. Heb je nog geen account, maak dan eerst een account aan. Dit doe je als volgt: vul een gebruikersnaam in en daarna een wachtwoord. Druk dan op <b>'Register'</b>.</p>
    </div>

</body>

<footer>
    <div id="txt"></div>
</footer>

</html>