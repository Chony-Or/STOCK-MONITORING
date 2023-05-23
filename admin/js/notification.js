function showNotification(products) {
    // Create the notification message
    var message = "Low Stock Products:\n";
    for (var i = 0; i < products.length; i++) {
        message += "- " + products[i].product_name + " (Stock: " + products[i].product_stock + ")\n";
    }

    // Show the notification as an alert
    alert(message);
}
