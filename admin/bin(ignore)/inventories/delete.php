<?php
include 'includes/session.php';

$conn = $pdo->open();
$msg = '';
// Check that the image ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Image doesn\'t exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete file & delete record
            unlink($product['product_picture']);
            $stmt = $conn->prepare('DELETE FROM product_tbl WHERE product_id = ?');
            $stmt->execute([ $_GET['product_id'] ]);
            // Output msg
            $msg = 'You have deleted the image!';
        } else {
            // User clicked the "No" button, redirect them back to the home/index page
            header('Location: index.php?page=inventory/inventory');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<div class="content delete">
	<h2>Delete Image #<?=$product['product_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete <?=$product['product_name']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$product['product_id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$product['product_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>
