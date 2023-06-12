<?php

    class ChartModel
    {
        private $conn;

        public function __construct($pdo)
        {
            $this->conn = $pdo;
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
