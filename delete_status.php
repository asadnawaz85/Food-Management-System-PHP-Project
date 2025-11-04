<?php
include "connection.php";
$id = $_GET['rid'];
$query = "DELETE FROM food_order WHERE id = $id";
$result = mysqli_query($conn_resul,$query);
if($result)
{
    echo "yes";
    header('location:all-orders.php');
    exit();
}
else
{
    echo "no";
}
?>
