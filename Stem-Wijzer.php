<?php
// Database connection parameters
    private $dataSource = "mysql:dbname=politiek;host=localhost;"; //Hier dient je connection string te komen mysql:dbname=;host=;
    private $username = "root";
    private $password = "WBNImzW8v86iFNy!SSIi8DkAmoJVoZDZvie9yAtvFKAgM$kM#XB$eB4Awjl0NT0V6W!cOqsbyeHkYcEUEJjl$@2";

// Create a connection to the database
//$conn = new mysqli($localhost, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your code goes here...

// Close the database connection
$conn->close();
?>

<?php
// Database of parties and their positions
$parties = [
    'VVD' => [
        'De provincie moet velden met zonnepanelen op landbouwgrond verbieden.' => false,
        'De provincie hoeft geen haast te maken met maatregelen die stikstofuitstoot verminderen.' => true,
        'De provincie moet meer geld uitgeven aan trainingsmogelijkheden voor getalenteerde topsporters.' => false,
        'Maastricht Aachen Airport moet gesloten worden.' => false
    ],
    'D66' => [
        'De provincie moet velden met zonnepanelen op landbouwgrond verbieden.' => false,
        'De provincie hoeft geen haast te maken met maatregelen die stikstofuitstoot verminderen.' => false,
        'De provincie moet meer geld uitgeven aan trainingsmogelijkheden voor getalenteerde topsporters.' => true,
        'Maastricht Aachen Airport moet gesloten worden.' => false
    ],
    'SP' => [
        'De provincie moet velden met zonnepanelen op landbouwgrond verbieden.' => true,
        'De provincie hoeft geen haast te maken met maatregelen die stikstofuitstoot verminderen.' => false,
        'De provincie moet meer geld uitgeven aan trainingsmogelijkheden voor getalenteerde topsporters.' => true,
        'Maastricht Aachen Airport moet gesloten worden.' => true
    ],
    // Add more parties and their positions here...
];

// Storing user's answers
$userAnswers = [
    'De provincie moet velden met zonnepanelen op landbouwgrond verbieden.' => true,
    'De provincie hoeft geen haast te maken met maatregelen die stikstofuitstoot verminderen.' => false,
    'De provincie moet meer geld uitgeven aan trainingsmogelijkheden voor getalenteerde topsporters.' => true,
    'Maastricht Aachen Airport moet gesloten worden.' => false
];

// Calculate the scores for each party
$scores = [];
foreach ($parties as $party => $positions) {
    $score = 0;
    foreach ($positions as $question => $positionValue) {
        if ($positionValue === $userAnswers[$question]) {
            $score++;
        }
    }
    $scores[$party] = $score;
}

// Sort the parties based on the scores
arsort($scores);

// Display the results
echo "Results:\n";
foreach ($scores as $party => $score) {
    echo $party . ": " . $score . " points\n";
}
?>

