
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
require 'db_connection.php';

$score = 0;
$total = 0;

$sql = "SELECT id, correct_ans FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question_id = $row['id'];
        $correct_ans = $row['correct_ans'];

        if (isset($_POST["question$question_id"]) && $_POST["question$question_id"] === $correct_ans) {
            $score++;
        }
        $total++;
    }
}

echo "<div class='container mt-5'>";
echo "<div class='alert alert-success text-center'>";
echo "Bạn trả lời đúng <strong>$score</strong>/$total câu.";
echo "</div>";
echo '<div class="text-center"><a href="index.php" class="btn btn-primary">Làm lại</a></div>';
echo "</div>";

$conn->close();
?>
