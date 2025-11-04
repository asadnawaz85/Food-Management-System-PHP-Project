<?php
include "connection.php";
 session_start();
if($_SESSION['role']!="User"):
  header("location:login.php");
exit();
endif;

$query="SELECT * FROM food_items WHERE status='Available'";
if(isset($_POST['submit']))
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
    exit;
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  
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
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

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
                        <li></i></a>
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
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				 <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $logged_in_user_data['name'];?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $logged_in_user_data['role'];?></p>
                </div>
            </div>
            </li>
            <li class="bold active"><a href="user-page.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Food</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="all-orders-user.php">All Orders</a>
                                </li>
              
                                    <li><a href="yet-to-be-deliver-orders-user.php">Orders Yet To Be Deliver</a>
                                    </li>
                                    <li><a href="Approved-by-Admin-user.php">Orders Approved</a>
                                    </li>
                                    <li><a href="Cancel-by-user.php">Cancel Orders</a>
                                    </li>
            
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                					
            <li class="bold"><a href="details.php?rid=<?php echo $logged_in_user_data['id'];?>" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Edit Details</a>
            </li>	
            <li class="bold"><a href="logout.php" class="waves-effect waves-cyan"><i class="fa-duotone fa-right-from-bracket"></i> Log Out</a>
            </li> 			
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Order</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Order your food here.</p>
          <div class="divider"></div>
		  
            <div class="col">
              <div class="col s12 m4 l3">
                <h4 class="header">Order Food</h4>
              </div>
              <form action="" method="POST">
        <div style="display: flex; justify-content: space-between;">
        <input type="search" name="search" placeholder="Search by Items Name" style="margin-right: 20px; width: 350px;margin-left: 20px;">
        <select name="status" style="margin-left: 20px; width: 350px;" class="col">
    <option value="">Select Status</option>
    <option value="Available">Available</option>
    <option value="Not Available">Not Available</option>
    </select>
        <input type="number" name="price" placeholder="Search by Items Price" style="margin-left: 20px; width: 350px; margin-right: 20px;">
        <input type="submit" name="submit" value="search" class="btn bg-danger white-text" style="margin-right: 5px;">
       </div> 
      </form><br>
              
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Price(per Kg)</th>
      <th scope="col">Status</th>
      <th scope="col">Stock/piece</th>
      <th scope="col">Place Order</th>
      
    </tr>
  </thead>
  <?php
    $count = 1 ;
    
    ?>
  <?php
        foreach($data as $row):
  ?>
  
  <!-- cnt--;

  stock [= cnt] -->
  <tbody>
    
    <tr>
      <th scope="row"><?php echo $count++;?></th>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['price'];?></td>
      <td><?php echo $row['status'];?></td>
      <td><?php echo $row['stock'];?></td>
      <?php
      
      ?>
      <?php 
      if($row['stock']>'0'):
      ?>
      <td><a href="order-food.php?rid=<?php echo $row['id'];?>" style="padding: 5px 10px;
      background-color: #bb0516;
      color: white;
      border-radius: 5px;
      ">Oder</a></td>
      <?php
    endif;
      ?>
      <?php 
      if($row['stock']<='0'):
      ?>
      <td><a href="user-page.php" style="padding: 5px 10px;
      background-color: #bb0561;
      color: white;
      border-radius: 5px;
      ">Out Of Stock</a></td>
      <?php
    endif;
      ?>
      
    </tr>
<?php
         endforeach;
?>    
</tbody>
</table>




  <!-- END MAIN -->
  <!-- form stara -->
  

      <!-- END CONTENT -->


  
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2023 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
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
    <script type="text/javascript">
    
    </script>
</body>

</html>
