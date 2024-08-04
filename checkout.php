<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $total = $_POST['total'];

    $sql = "INSERT INTO orders (user_id, total) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $userId, $total);
    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;
        foreach ($_SESSION['cart'] as $courseId => $quantity) {
            $sql = "INSERT INTO order_items (order_id, course_id, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $orderId, $courseId, $quantity);
            $stmt->execute();
        }
        unset($_SESSION['cart']);
        header("Location: order_success.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
