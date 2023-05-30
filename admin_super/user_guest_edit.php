<?php

include 'includes/session.php';

$conn = $pdo->open();

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $guest_name = isset($_POST['guest_name']) ? $_POST['guest_name'] : '';
        $guest_address = isset($_POST['guest_address']) ? $_POST['guest_address'] : '';
        $guest_contact = isset($_POST['guest_contact']) ? $_POST['guest_contact'] : '';

        // Update the record
        $stmt = $conn->prepare('UPDATE customer_tbl SET customer_name= ?, customer_address = ?, customer_contactNo = ? WHERE customer_id = ?');
        $stmt->execute([$guest_name, $guest_address, $guest_contact, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }

    // Get the contact from the contacts table
    $stmt = $conn->prepare('SELECT * FROM customer_tbl WHERE customer_id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Customer doesn\'t exist with that ID!');
    }
    $pdo->close();
}

else
{
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: user_guest.php');

?>
