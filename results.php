<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="../Project2/css/results.css">
</head>
<body>
    <header>Results</header>
    <div>
        <h2>Your Best Matching Party:</h2>
        <div>
            <h3>VVD</h3>
            <p><?php include('Calculatour/vvd.php'); ?></p>
        </div>
        <div>
            <h3>D66</h3>
            <p><?php include('Calculatour/d66.php'); ?></p>
        </div>
        <div>
            <h3>SP</h3>
            <p><?php include('Calculatour/sp.php'); ?></p>
        </div>
    </div>
    <form method="post" action="login.php">
        <button type="submit" name="reset">Reset Application</button>
    </form>
</body>
<footer></footer>
</html>
