
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
require 'db_connection.php';
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<form method="POST" action="submit_quiz.php">';
    echo '<div class="container mt-5">'; 
    echo '<h3 class="text-center mb-4">Quiz Questions</h3>'; 

    while ($row = $result->fetch_assoc()) {
        echo "<div class='question-container mb-4 border p-4 rounded'>";
        echo "<p><strong>Question {$row['id']}:</strong> " . htmlspecialchars($row['question']) . "</p>"; 

        foreach (['A', 'B', 'C', 'D'] as $option) {
            $value = htmlspecialchars($row["option_" . strtolower($option)]);
            $inputId = "question{$row['id']}_option{$option}";
            
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='radio' name='question{$row['id']}' value='{$option}' id='{$inputId}'>";
            echo "<label class='form-check-label' for='{$inputId}'>{$value}</label>";
            echo "</div>";
        }
        echo "</div>";
    }
    echo '<div class="text-center"><button type="submit" class="btn btn-primary">Submit Quiz</button></div>';
    echo '</div>';
    echo '</form>';
} else {
    echo "<div class='container mt-5'><p>No questions available. Please try again later.</p></div>";
}

$conn->close();
?>
