<?php
require 'database.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        if (move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image)) {
            addFlower($conn, $name, $description, $image);
            echo "<script>alert('Thêm hoa thành công!');</script>";
        } else {
            echo "<script>alert('Không thể tải ảnh lên!');</script>";
        }
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteFlower($conn, $id);
        echo "<script>alert('Xóa hoa thành công!');</script>";
    }
}

$flowers = getFlowers($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị hoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
        }
        .btn-danger:hover {
            background-color: #e41e1e;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #008CBA;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quản trị các loài hoa</h1>

        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <label for="name">Tên hoa</label>
                <input type="text" name="name" id="name" placeholder="Tên hoa" required>

                <label for="description">Mô tả</label>
                <textarea name="description" id="description" placeholder="Mô tả" required></textarea>

                <label for="image">Ảnh</label>
                <input type="file" name="image" id="image" accept="image/*" required>

                <button type="submit" name="add" class="btn-primary">Thêm Hoa</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td><?php echo $flower['name']; ?></td>
                        <td><?php echo $flower['description']; ?></td>
                        <td><img src="images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>" width="100"></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
                                <button type="submit" name="delete" class="btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="index.php" class="btn-primary">Quay lại trang chính</a>
        </div>
    </div>
</body>
</html>
