<?php 
include "connection.php";
session_start();
if($_SESSION['role']!="Admin"):
  header("location:login.php");
exit();
endif;
$query="SELECT * FROM food_order WHERE status='Yet to be Delivered' ORDER BY id DESC ";
$data = [];
$query_result=mysqli_query($conn_resul,$query);
if($query_result->num_rows>0)
 {

   $data=mysqli_fetch_all($query_result,MYSQLI_ASSOC);
   

 }
 else
  {
    echo "no data found";
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
  <!-- Start Page Loading -->
  <!-- <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div> -->
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
                    <a class="btn-flat waves-effect white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $logged_in_user_data['name'];?></a>
                    <p class="user-roal"><?php echo $logged_in_user_data['role'];?></p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Food Menu</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <!-- <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
                            <li><a href="all-orders.php">All Orders</a></li>
                                
                                </ul>
                            </div>

                        </li>
                    </ul>
                </li> -->


             <li class="bold"><a href="all-orders.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>All Orders</a>
            </li> 
            <li class="bold active"><a href="yet-to-be-deliver-orders.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>Orders Yet To Be Deliver</a>
            </li> 
            <li class="bold"><a href="Approved-by-Admin.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>Orders Appreoved</a>
            </li>
            <li class="bold"><a href="cancel-orders.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>Canceled Orders</a>
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
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">All Orders</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">List of orders by customers with details</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
             
				<h4 class="header">List</h4>
                
				<?php 
				foreach ($data as $row):
				 ?>	
                <div>
                    
                    <ul id="issues-collection" class="collection">
					<li class="collection-item avatar">
                              <i class="mdi-content-content-paste red circle"></i>
                              <span class="collection-header">Order No: <b><?php echo $row['id']; ?></b></span>
                              <p><strong>Date :<?php echo $row['created_at']; ?></strong></p>
                              	<?php 
                                                if($row['status']=='Approved by Admin'): 
                                ?>						  
							  <p><strong>Status:</strong><div class="btn white-text bg-dark"><?php echo $row['status']; ?></div>
                                <?php
                                                endif;
                                ?>
                                <?php 
                                                if($row['status']=='Yet to be Delivered'): 
                                ?>                        
                              <p><strong>Status:</strong><div class="btn white-text bg-primary"><?php echo $row['status']; ?></div></p>
                                <?php
                                                endif;
                                ?>
							  <!-- <form method="post" action=""> -->
							    <!-- <input type="hidden" value="" name="id">
								<select name="status">
								<option value="Yet to be delivered">Yet to be delivered</option>
								<option value="Delivered">Delivered</option>
								<option value="Cancelled by Admin">Cancelled by Admin</option>
								<option value="Paused">Paused</option>								
								</select> -->
							  
                              <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li><li class="collection-item">
                            <div class="col">
							<p><strong>Name:</strong><?php echo $row['user_name']; ?></p>
							<p><strong>Address:</strong><?php echo $row['address']; ?></p>
                            <p><strong>Contact: </strong><?php echo $row['phone']; ?></p>
                            <p><strong>Email: </strong><?php echo $row['email']; ?></p>
                            <p><strong>Note:</strong><?php echo $row['discription'];?></p>								
                            </li><li class="collection-item">
                            <div class="row">
                            <div class="col s7">
                            <p class="collections-title"><strong>item name:</strong>  <?php echo $row['item_name'];?></p>
                            </div>
                            <div class="col s2">
                            <p class="collections-title"><strong>Quantaty:</strong>  <b><?php echo $row['quantaty'];?></b> /piece</p>
                            </div>
                            <div class="col s3">
                            <p class="collections-title"><strong>Price:</strong>  <?php echo $row['item_price'];?> /-</p>
                            </div>
                            </div>
                            </li>
                            <?php  
                            $total=$row['item_price'] * $row['quantaty'];
                            ?>
                            <li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total Price:</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>Rs.<?php echo $total; ?></strong></span>
                                            </div>
                                            <?php 
                                                if($row['status']=='Approved by Admin'): 
                                            ?>
                                            <a href="change_status2.php?rid=<?php echo $row['id'];?>" class="btn waves-effect waves-light right submit" style="color: white;background-color: red;">Paused</a>
                                            <?php
                                                endif;
                                            ?>
                                            <?php 
                                                if($row['status']=='Yet to be Delivered'): 
                                            ?>
                                            <a href="change_status2.php?rdid=<?php echo $row['id'];?>" class="btn waves-effect waves-light right submit" style="color: white;background-color: red;">Approved</a>
                                            <?php
                                                endif;
                                            ?>
                                            
										<!--</form>-->
                                    </div></li>
					</ul>
                    <?php 
                endforeach;
                exit;
                 ?>
                </div>
                
              </div>

            </div>

        </div>
        
        <!--end container-->

      </section>

      <!-- END CONTENT -->
    </div>

    <!-- END WRAPPER -->

  </div>


  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2017 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
        <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">Students</a></span>
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
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
