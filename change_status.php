<?php
include "connection.php";

if (isset($_GET['rid'])) 
        {

            // form validation 


            
                $id = $_GET['rid'];

             $querry2 = "UPDATE food_order SET status = 'Yet to be Delivered'WHERE id = $id";
             $querry_result = mysqli_query($conn_resul,$querry2);
             if($querry_result){
             	header("location:all-orders.php");
             		exit;
             	}
             }
             if (isset($_GET['rdid'])) 
        {

            // form validation 


            
                $id = $_GET['rdid'];

             $querry2 = "UPDATE food_order SET status = 'Approved by Admin'WHERE id = $id";
             $querry_result = mysqli_query($conn_resul,$querry2);
             if($querry_result){
                header("location:all-orders.php");
                    exit;
                }
             }


?>