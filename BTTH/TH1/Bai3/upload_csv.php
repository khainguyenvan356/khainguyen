<?php
require 'db_connection.php';

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Tạo thư mục uploads
    }

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "csv") {
        echo "Chỉ cho phép tải tệp CSV!";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Tệp không được tải lên.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Tệp ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " đã được tải lên.";

            if (($handle = fopen($target_file, "r")) !== FALSE) {
                fgetcsv($handle); 

                while (($data = fgetcsv($handle)) !== FALSE) {
                    $student_id = $data[0];
                    $full_name = $data[1];
                    $dob = $data[2];
                    $class = $data[3];
                    $average_score = $data[4];

                    $sql = "INSERT INTO students (student_id, full_name, dob, class, average_score) 
                            VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bind_param("sssss", $student_id, $full_name, $dob, $class, $average_score);
                    $stmt->execute();
                }
                fclose($handle);
                
                header("Location: students_list.php");
                exit(); 
            }
        } else {
            echo "Có lỗi khi tải tệp lên!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tải tệp CSV lên</h1>
        <form action="upload_csv.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Chọn tệp CSV</label>
                <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tải tệp lên</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
