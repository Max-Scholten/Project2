<?php
session_start();

$hostname = 'localhost'; // Change this to your database server hostname
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password
$database = 'stemwijzer'; // Change this to your database name

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userId'] = $row['userId'];
            header("Location: questionnaire.php");
            exit();
        } else {
            $errorMessage = "Invalid username or password";
        }
    } elseif (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === true) {
            $successMessage = "User registered successfully. Please login.";
        } else {
            $errorMessage = "Error registering user: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../Project2/login.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($errorMessage)) : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <?php if (isset($successMessage)) : ?>
        <p><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
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
</body>
</html>
