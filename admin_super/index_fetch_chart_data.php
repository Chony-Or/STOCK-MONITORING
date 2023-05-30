<?php

    include 'includes/session.php';

    // Function to fetch the chart data
    function fetchChartData($conn)
    {
        // Query the product_tbl table for product names and product stock
        $stmt = $conn->prepare('SELECT product_name, product_stock FROM product_tbl WHERE is_active = 1');
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create data arrays for labels, values, and background colors
        $labels = [];
        $values = [];
        $colors = [];

        foreach ($products as $product)
        {
            $labels[] = $product['product_name'];
            $values[] = $product['product_stock'];
            if ($product['product_stock'] >= 10)
            {
                $colors[] = 'rgba(54, 162, 235, 0.6)'; // Blue color for stock 10 and above
            }
            else
            {
                $colors[] = 'rgba(255, 99, 132, 0.6)'; // Red color for stock below 10
            }
        }

        // Create an associative array with the updated chart data
        $chartData =
        [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ];

        return $chartData;
    }

    // Check if the request is AJAX wala lang trip ko lang itry AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        // Fetch the updated chart data
        $chartData = fetchChartData($conn);

        // Convert the chart data to JSON format
        $chartDataJson = json_encode($chartData);

        // Send the JSON response
        header('Content-Type: application/json');
        echo $chartDataJson;
    }
    else
    {
        // Redirect or handle non-AJAX requests as desired
        // For example, you can redirect back to the index page
        header('Location: index.php');
    }

?>
