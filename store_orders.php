<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $order_name = $_POST['order_name'];
  $total_price = $_POST['total_price'];
  $mob_no = $_POST['mob_no'];
  $address = $_POST['address'];

  $sql = "INSERT INTO orders (order_name, total_price, mob_no, address)
        VALUES ('$order_name', '$total_price', '$mob_no', '$address')";


  if ($conn->query($sql) === TRUE) {
    echo "<h2>Order placed successfully!</h2>";
    echo "<a href='orders.php'>View Orders</a>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
