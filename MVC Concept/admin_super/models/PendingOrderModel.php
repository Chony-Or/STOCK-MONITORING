<?php

    class PendingOrderModel
    {
        private $conn;

        public function __construct($pdo)
        {
            $this->conn = $pdo;
        }

        public function getOverviewData()
        {
            // Retrieve overview data from the database
            $query = "SELECT COUNT(*) AS numrows FROM transachistory_tbl";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $urow = $stmt->fetch();

            $overviewData['numPurchases'] = $urow['numrows'];

            $query = "SELECT COUNT(*) AS numrows FROM product_tbl";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $urow = $stmt->fetch();

            $overviewData['numProducts'] = $urow['numrows'];

            $query = "SELECT COUNT(*) AS numrows FROM customer_tbl";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $urow = $stmt->fetch();

            $overviewData['numUsers'] = $urow['numrows'];

            $query = "SELECT COUNT(*) AS numrows FROM pendingorder_tbl";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $urow = $stmt->fetch();

            $overviewData['numPendingOrders'] = $urow['numrows'];

            return $overviewData;
        }

        public function getPendingOrders()
        {
            // Retrieve pending orders from the database
            $query = "SELECT *, pendingorder_tbl.pendingOrder_id AS pending FROM pendingorder_tbl 
                    LEFT JOIN customer_tbl ON customer_tbl.customer_id=pendingorder_tbl.customer_id 
                    GROUP BY order_number 
                    ORDER BY pendingorder_id";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $pendingOrders = $stmt->fetchAll();

            return $pendingOrders;
        }

        public function getLowStockCount()
        {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS numrows FROM product_tbl WHERE product_stock < 10");
            $stmt->execute();
            $urow = $stmt->fetch();

            return $urow['numrows'];
        }

        public function getLowStockProducts()
        {
            $stmt = $this->conn->prepare('SELECT * FROM product_tbl WHERE product_stock < 10');
            $stmt->execute();
            $lowStockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $lowStockProducts;
        }

        public function getChartData()
        {
            $stmt = $this->conn->prepare('SELECT product_name, product_stock FROM product_tbl WHERE is_active = 1');
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $labels = [];
            $values = [];
            $colors = [];

            foreach ($products as $product)
            {
                $labels[] = $product['product_name'];
                $values[] = $product['product_stock'];

                if ($product['product_stock'] >= 10)
                {
                    $colors[] = 'rgba(54, 162, 235, 0.6)';
                }
                else
                {
                    $colors[] = 'rgba(255, 99, 132, 0.6)';
                }
            }

            $chartData = [
                'labels' => $labels,
                'values' => $values,
                'colors' => $colors
            ];

            return $chartData;
        }
    }
    
?>
