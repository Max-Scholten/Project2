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
}

$conn = null;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <link rel="stylesheet" href="../Project2/css/login.css">
    <script src="../Project2/js/login.js" defer></script>

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
                <button type="submit" name="login">Login</button>
                <button type="submit" name="register">Register</button>
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
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui similique consequuntur 
            recusandae quod veniam doloribus facere, voluptatum, laboriosam, sunt nemo provident odio 
            esse mollitia molestiae dolorem itaque soluta nostrum nihil!</p>

    </div>


</body>
<footer>
    <div id="txt"></div>
</footer>

</html>