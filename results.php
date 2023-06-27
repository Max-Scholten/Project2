<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="../Project2/css/results.css">
    <script src="../Project2/js/iets.js" defer></script>
</head>
<body onload="startTime()">
    <header>Results</header>
    <div id="tekst">
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
        <form method="post" action="login.php">
            <div id="bt"><button id="reset" type="submit" name="reset">Log out</button></div>
        </form>
        <form method="get" action="questionnaire.php">
            <div id="bt"><button id="goBack" type="submit">Do the test again</button></div>
        </form>
    </div>
   
</body>
<footer><div id="txt"></div></footer>
</html>
