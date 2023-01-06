<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM productclass_tbl");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['productclass_id']."' class='append_items'>".$row['product_class']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>