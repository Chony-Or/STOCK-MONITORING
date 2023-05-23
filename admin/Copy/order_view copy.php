<!-- view -->
<div class="modal fade" id="view_<?php echo $row['order_number'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl ">

        <!-- Modal Edit Content -->
        <div class="modal-content">

            <!-- Modal Edit Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order Overview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Edit Body -->
            <div class="modal-body">
                <h4>Order Details</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch the product details for the specific order
                        $orderNumber = $row['order_number'];
                        $stmt = $conn->prepare('SELECT * FROM pendingorder_tbl WHERE order_number = :orderNumber');
                        $stmt->bindParam(':orderNumber', $orderNumber);
                        $stmt->execute();
                        $orderDetails = $stmt->fetchAll();

                        foreach ($orderDetails as $orderItem) {
                            $productId = $orderItem['product_id'];
                            $productStmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_id = :productId');
                            $productStmt->bindParam(':productId', $productId);
                            $productStmt->execute();
                            $product = $productStmt->fetch();
                        ?>
                            <tr>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $orderItem['quantity']; ?></td>
                                <td><?php echo $orderItem['amount']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Edit Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="acceptOrder(<?php echo $orderNumber; ?>)">Accept</button>
                <button type="button" class="btn btn-danger" onclick="declineOrder(<?php echo $orderNumber; ?>)">Decline</button>
            </div>

            <script>
                function acceptOrder(orderNumber) {
                    // Perform the necessary actions to accept the order
                    // You can use JavaScript, AJAX, or submit a form to handle the action
                    console.log('Accept order: ' + orderNumber);
                }

                function declineOrder(orderNumber) {
                    // Perform the necessary actions to decline the order
                    // You can use JavaScript, AJAX, or submit a form to handle the action
                    console.log('Decline order: ' + orderNumber);
                }
            </script>

            <!-- Modal Edit Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </div>

</div>