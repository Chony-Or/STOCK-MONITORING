<?php
include 'includes/session.php';


if (isset($_POST['id'])) {

    $id = $_GET['id'];

    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT * FROM pendingorder_tbl WHERE order_number = :id");
    $stmt->execute(['id'=>$id]);
    $result = $stmt->fetch();

    try {
        $stmt = $conn->prepare("INSERT INTO on_processorder_tbl (product_id, customer_id, quantity, amount, is_active)
        SELECT product_id, customer_id, quantity, amount, is_active FROM pendingorder_tbl)");
        $_SESSION['success'] = 'User added successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    header('order.php');

}