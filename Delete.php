<?php
include "connection.php";
$id = $_GET['rid'];
$query = "DELETE FROM food_items WHERE id = $id";
$result = mysqli_query($conn_resul,$query);
if($result)
{
    echo "yes";
    header('location:index.php');
    exit();
}
else
{
    echo "no";
}
?>
