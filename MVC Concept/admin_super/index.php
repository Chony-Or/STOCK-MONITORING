<?php

    // Include necessary files
    require 'models/PendingOrderModel.php';
    require 'models/ChartModel.php';
    require 'controllers/DashboardController.php';

    // Create objects
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=full;charset=utf8mb4", "root", "");

        $model = new PendingOrderModel($pdo);
        $chartModel = new ChartModel($pdo);

        $controller = new DashboardController($model);
    }
    catch (PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    // Retrieve data
    $overviewData = $controller->getOverviewData();
    $pendingOrders = $controller->getPendingOrders();
    $lowStockData = $controller->getLowStockData();
    $lowStockProducts = $controller->getLowStockProducts();
    $chartData = $controller->getChartData();

    // Include the main view file
    include 'views/dashboard.php';
    
?>
