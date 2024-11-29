<?php
function getFlowers($conn) {
    $sql = "SELECT * FROM flowers";
    $result = $conn->query($sql);

    $flowers = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $flowers[] = $row;
        }
    }
    return $flowers;
}

function addFlower($conn, $name, $description, $image) {
    $stmt = $conn->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $image);
    $stmt->execute();
    $stmt->close();
}

function deleteFlower($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
