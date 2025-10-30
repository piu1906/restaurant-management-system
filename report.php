<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "restro"; // change to your actual DB name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>📅 Monthly Report</h2>";

$monthly = "
SELECT 
    DATE_FORMAT(order_date, '%M %Y') AS month_name,
    MIN(order_date) AS start_date,
    MAX(order_date) AS end_date,
    COUNT(order_id) AS total_orders,
    SUM(total_price) AS total_sales
FROM orders
GROUP BY YEAR(order_date), MONTH(order_date)
ORDER BY YEAR(order_date), MONTH(order_date);
";

$result1 = $conn->query($monthly);

if ($result1->num_rows > 0) {
    echo "<table border='1' cellpadding='8' style='border-collapse: collapse; text-align: center;'>
            <tr style='background-color: #007bff; color: white;'>
                <th>Month</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Total Orders</th>
                <th>Total Sales (₹)</th>
            </tr>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr>
                <td>{$row['month_name']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['end_date']}</td>
                <td>{$row['total_orders']}</td>
                <td>{$row['total_sales']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found for monthly report.";
}

echo "<br><h2>📆 Yearly Report</h2>";

$yearly = "
SELECT 
    YEAR(order_date) AS year,
    MIN(order_date) AS start_date,
    MAX(order_date) AS end_date,
    COUNT(order_id) AS total_orders,
    SUM(total_price) AS total_sales
FROM orders
GROUP BY YEAR(order_date)
ORDER BY YEAR(order_date);
";

$result2 = $conn->query($yearly);

if ($result2->num_rows > 0) {
    echo "<table border='1' cellpadding='8' style='border-collapse: collapse; text-align: center;'>
            <tr style='background-color: #28a745; color: white;'>
                <th>Year</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Total Orders</th>
                <th>Total Sales (₹)</th>
            </tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>
                <td>{$row['year']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['end_date']}</td>
                <td>{$row['total_orders']}</td>
                <td>{$row['total_sales']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found for yearly report.";
}

$conn->close();
?>
