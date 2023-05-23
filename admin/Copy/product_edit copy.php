<?php

include 'includes/session.php';

$pdo_conn = $pdo->open();

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
        $customer_number = isset($_POST['customer_number']) ? $_POST['customer_number'] : '';
        $checkin_date = isset($_POST['checkin_date']) ? $_POST['checkin_date'] : '';
        $checkout_date = isset($_POST['checkout_date']) ? $_POST['checkout_date'] : '';
        $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : '';
        $room_capacity = isset($_POST['room_capacity']) ? $_POST['room_capacity'] : '';
        $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
        $paymentDiscount = isset($_POST['paymentDiscount']) ? $_POST['paymentDiscount'] : '';

        // Calculate number of days stayed
		$datetime1 = date_create($checkin_date);
		$datetime2 = date_create($checkout_date);
		$interval = date_diff($datetime1, $datetime2);
		$numDays = $interval->format('%a');
	
	
		// Validate the user input
		if (empty($customer_name) || empty($checkin_date) || empty($checkout_date) || empty($room_type) || empty($payment_type)) {
			die("Please fill out all fields.");
		}
	
		if ($checkin_date > $checkout_date) {
			die("Check-out date must be after check-in date.");
		}
	
		// Retrieve room price from the database based on room capacity and type
		switch ($room_capacity) {
			case 'Single':
				switch ($room_type) {
					case 'Regular':
						$room_price = 100.00;
						break;
					case 'Deluxe':
						$room_price = 300.00;
						break;
					case 'Suite':
						$room_price = 500.00;
						break;
					default:
						die('Invalid room type');
				}
				break;
			case 'Double':
				switch ($room_type) {
					case 'Regular':
						$room_price = 200.00;
						break;
					case 'Deluxe':
						$room_price = 500.00;
						break;
					case 'Suite':
						$room_price = 800.00;
						break;
					default:
						die('Invalid room type');
				}
				break;
			case 'Family':
				switch ($room_type) {
					case 'Regular':
						$room_price = 500.00;
						break;
					case 'Deluxe':
						$room_price = 750.00;
						break;
					case 'Suite':
						$room_price = 1000.00;
						break;
					default:
						die('Invalid room type');
				}
				break;
			default:
				die('Invalid room capacity');
		}

		// Retrieve payment details from the form data
		$payment_type = $_POST['payment_type'];

		// Calculate payment surcharge and discount based on payment type and number of days stayed
		switch ($payment_type) {
			case 'Cash':
				if ($numDays >= 6) {
					$paymentDiscount = $room_price * 0.15;
				} elseif ($numDays >= 3 && $numDays <= 5) {
					$paymentDiscount = $room_price * 0.10;
				} else {
					$paymentDiscount = 0.00;
				}
				$paymentSurcharge = 0.00;
				break;
			case 'Credit_Card':
				$paymentSurcharge = 0.10;
				break;
			case 'Cheque':
				$paymentSurcharge = 0.05;
				break;
			default:
				die('Invalid payment type');
		}

		try {
			// Calculate total amount due
			$total_amountDue = $room_price * $numDays + $paymentSurcharge - $paymentDiscount;
		} catch (TypeError $e) {
			echo 'Caught TypeError: ' . $e->getMessage();
		}


        // Update the record
        $pdo_statement = $pdo_conn->prepare('UPDATE reservations SET customer_name = ?, customer_number = ?, checkin_date = ?, checkout_date = ?, room_type = ?, room_capacity = ?, room_price = ?, payment_type = ?, payment_discount = ?, payment_surcharge = ?, total_amount_due = ? WHERE reservation_id = ?');
        $pdo_statement->execute([$customer_name, $customer_number, $checkin_date, $checkout_date, $room_type, $room_capacity, $room_price, $payment_type, $paymentDiscount, $paymentSurcharge, $total_amountDue, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $pdo_statement = $pdo_conn->prepare('SELECT * FROM reservations WHERE reservation_id = ?');
    $pdo_statement->execute([$_GET['id']]);
    $contact = $pdo_statement->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Customer doesn\'t exist with that ID!');
    }
    $pdo->close();
}

else
{
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: dashboard.php');

?>
