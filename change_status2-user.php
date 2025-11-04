<?php
include "connection.php";
// if (isset($_GET['rid'])) 
//         {

//             // form validation 


            
//                 $id = $_GET['rid'];
//             $connection = mysqli_connect("localhost","root","","php_project");

//              $querry2 = "UPDATE food_order SET status = 'Yet to be Delivered'WHERE id = $id";
//              $querry_result = mysqli_query($connection,$querry2);
//              if($querry_result){
//              	header("location:Approved-by-Admin.php");
//              		exit;
//              	}
//              }
             if (isset($_GET['rdid'])) 
        {

            // form validation 


            
                $id = $_GET['rdid'];

             $querry2 = "UPDATE food_order SET status = 'Cancel by User'WHERE id = $id";
             $querry_result = mysqli_query($conn_resul,$querry2);
             if($querry_result){
                header("location:Cancel-by-user.php");
                    exit;
                }
             }


?>