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
    if (isset($_POST['register'])) {
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
    } elseif (isset($_POST['update'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $successMessage = "Password updated successfully. Please login.";
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Error updating password: " . $stmt->errorInfo()[2];
        }
    } elseif (isset($_POST['delete'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>
                    if (confirm('Are you sure you want to delete your account?')) {
                        window.location.href = 'delete_account.php?username=$username';
                    }
                </script>";
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
    <title>Account Settings</title>
    <link rel="stylesheet" href="../Project2/css/login.css">
    <script src="../Project2/js/iets.js" defer></script>
    
</head>

<body onload="startTime()">
    <header>
    <div id="asettings"><a href="login.php" class="account-settings-button">Login</a></div>
    Account Settings
    </header>

    <div id="formi">
        <form method="POST" action="">
            <h2>Change Password</h2>
            <div>
                <label for="update-username">Username:</label>
                <input type="text" id="update-username" name="username" required>
            </div>
            <div>
                <label for="update-password">New Password:</label>
                <input type="password" id="update-password" name="password" required>
            </div>
            <div>
                <button id="update" type="submit" name="update">Update Password</button>
            </div>
        </form>
        <?php if (isset($errorMessage)) : ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <?php if (isset($successMessage)) : ?>
            <p><?php echo $successMessage; ?></p>
        <?php endif; ?>

    </div>

    <div id="delete-form">
        <form method="POST" action="">
            <h2>Delete Account</h2>
            <div>
                <label for="delete-username">Username:</label>
                <input type="text" id="delete-username" name="username" required>
            </div>
            <div>
                <label for="delete-password">Password:</label>
                <input type="password" id="delete-password" name="password" required>
            </div>
            <div>
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

</body>

<footer>
    <div id="txt"></div>
</footer>

</html>

