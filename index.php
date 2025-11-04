<?php

session_start();
include "connection.php";
if($_SESSION['role']!="Admin"):
  header("location:login.php");
exit();
endif;
if(isset($_POST['submit'])){
 $name=$_POST['name'];
 $price=$_POST['price']; 
 
 $query="INSERT INTO food_items (name,price) 
    VALUES('$name','$price')";
    $query_result=mysqli_query($conn_resul,$query);
    if ($query_result==1) {
      //echo "succesful";
             //header("location:login.php");
            
    }
    else{
      echo "error";
    }
}

$query="SELECT * FROM food_items";
if(isset($_POST['submit-btn']))
{
  $search = $_POST['search'];
  $status = $_POST['status'];
  $price = $_POST['price'];
  if(!empty($search)){
    $query="SELECT * FROM food_items WHERE name LIKE '$search%'";
  }
  elseif (!empty($status)) {
    $query="SELECT * FROM food_items WHERE status = '$status'";
  }
  elseif (!empty($price)) {
    $query="SELECT * FROM food_items WHERE price < '$price' OR price = '$price'";
  }
}
$data=[];
$query_result=mysqli_query($conn_resul,$query);
if($query_result->num_rows>0)
 {
   $data=mysqli_fetch_all($query_result,MYSQLI_ASSOC);
   

 }
 else
 { 
  
  echo '<script> alert ("no data found!") </script>';

 }


 
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    
   $query= "SELECT * FROM registration WHERE id = $user_id";
   $query_result = mysqli_query($conn_resul,$query);

   if($query_result->num_rows > 0)
   {
     $logged_in_user_data = mysqli_fetch_assoc($query_result);
   }
}





  if(!isset($_SESSION['user_id']))
  {
    header("location: login.php");
    
  }
  

		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Order Food</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  
   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style> 
</head>

<body>
  

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">                        
                        
                        </li>
                    </ul>					
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                
				 
                <div class="col col s8 m8 l8">
                    <a class="btn-flat waves-effect white-text profile-btn" href="#" data-activates="profile-dropdown"><b>Welcom:</b><?php echo $logged_in_user_data['name'];?></a>
                    <p class="user-roal"><b><?php echo $logged_in_user_data['role'];?></b></p>
                </div>
            </div>
            </li>
            <li class="bold active"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i>Food Menu</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="all-orders.php">All Orders</a>
                                </li>
							
                                    <li><a href="yet-to-be-deliver-orders.php">Orders Yet To Be Deliver</a>
                                    </li>
                                    <li><a href="Approved-by-Admin.php">Orders Approved</a>
                                    </li>
                                    <li><a href="Cancel-orders.php">Cancel Orders</a>
                                    </li>
						
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                					
            <li class="bold"><a href="details.php?rid=<?php echo $logged_in_user_data['id'];?>" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Edit Details</a>
            </li>
            <li class="bold"><a href="users.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i>Users</a>
            </li>	
            <li class="bold"><a href="logout.php" class="waves-effect waves-cyan"><i class="fa-duotone fa-right-from-bracket"></i> Log Out</a>
            </li>			
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <h1 style="text-align: center;">Order your Food Here</h1>
      <hr>
      <h3 style="padding-left: 20px;">ORDER FOOD</h3>
      
      <form action="" method="POST">
        <div style="display: flex; justify-content: space-between;">
        <input type="search" name="search" placeholder="Search by Items Name" style="margin-right: 20px; width: 350px;margin-left: 20px;">
        <select name="status" style="margin-left: 20px; width: 350px;" class="col">
    <option value="">Select Status</option>
    <option value="Available">Available</option>
    <option value="Not Available">Not Available</option>
    </select>
        <input type="number" name="price" placeholder="Search by Items Price" style="margin-left: 20px; width: 350px; margin-right: 20px;">
        <input type="submit" name="submit-btn" value="search" class="btn bg-danger white-text" style="margin-right: 5px;">
       </div> 
      </form><br>
      
<form action="" method="POST">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Price(per Kg)</th>
      <th scope="col">Status</th>
      <th scope="col">Stock/piece</th>
      <th scope="col">Modify/Update</th>
    </tr>
  </thead>
  
  <?php
  $count=1;
        foreach($data as $row):
  ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $count++;?></th>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['price'];?></td>
      <td><?php echo $row['status'];?></td>
      <td><?php echo $row['stock'];?></td>
      <td><a href="edit-items.php?rid=<?php echo $row['id'];?>" class="btn cyan waves-effect waves-light right white-text" style="margin-right: 50px;
width: 50%;">Modify</a><br><br><a href="Delete.php?rid=<?php echo $row['id'];?>" class="btn cyan waves-effect waves-light right white-text" style="margin-right: 50px;
width: 50%;">Delete</a></td>
    </tr>
    <?php
         endforeach;
         ?>
</tbody>
</table>


</form>
  <!-- END MAIN -->
  <!-- form stara -->
    
  <h1 class="text-center blue-text">Add Food Items</h1>
  <hr>
  <form action="" method="POST">
    <input type="text" name="name" placeholder="Name" style="width: 40%;margin-left: 50px;">
    <input type="number" name="price" placeholder="Price" style="width: 40%;margin-left: 50px;"><br><br>
    <div style="display: flex; justify-content: space-evenly;">
    <input type="submit" name="submit" value="Add Food" style="width: 20%;padding-bottom: 38px;" class="btn btn-danger btn-lg">
    
    </div>



  <!-- </form>
  <hr>
  <form action="" method="POST">
    <input type="text" name="i-name" placeholder="Name" style="width: 40%;margin-left: 50px;" value="<?php  echo $actual_data['name']; ?>">
    <input type="number" name="i-price" placeholder="Price" style="width: 40%;margin-left: 50px;" value="<?php  echo $actual_data['price']; ?>"><br><br>
    <div style="display: flex; justify-content: space-evenly;">
    
    <input type="submit" name="edit" value="Edit Item" style="width: 20%;padding-bottom: 38px;" class="btn btn-success btn-lg">
    </div>

    
  </form> -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2024 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
        <span class="right">Developed by <a class="grey-text text-lighten-4" href="https://web.facebook.com/profile.php?id=61556832434017">Asad Nawaz</a></span>
        </div>
    </div>
  </footer>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
	
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    
</body>

</html>
