<?php

    class DashboardController
    {
        private $model;

        public function __construct($model){
            $this->model = $model;
        }

        public function getOverviewData() {
            return $this->model->getOverviewData();
        }

        public function getPendingOrders() {
            return $this->model->getPendingOrders();
        }

        public function getLowStockData() {
            return $this->model->getLowStockCount();
        }

        public function getLowStockProducts() {
            return $this->model->getLowStockProducts();
        }

        public function getChartData() {
            return $this->model->getChartData();
        }
    }
    
?>
