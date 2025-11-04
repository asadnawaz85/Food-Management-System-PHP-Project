<?php
include "connection.php";
session_start();
if($_SESSION['role']!="Admin"):
  header("location:login.php");
exit();
endif;

$query="SELECT * FROM registration WHERE role='User'";
if(isset($_POST['submit-btn']))
{
  $search = $_POST['search'];
  
  $address = $_POST['address'];
  if(!empty($search)){
    $query="SELECT * FROM registration WHERE name LIKE '$search%' AND role='User'";
  }
  elseif (!empty($address)) {
    $query="SELECT * FROM registration WHERE address LIKE '$address%' AND role='User'";
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
    exit;
  }
  // if($actul_data['role']=="Admin"){
  //     header("location:index.php");
  //   }
  //   else

  //   {
  //     header("location:login.php");
  //   }

		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>User List</title>

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

  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
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
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $logged_in_user_data['name'];?></a>
                    <p class="user-roal"><?php echo $logged_in_user_data['role'];?></p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Food Menu</a>
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
            <li class="bold active"><a href="users.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Users</a>
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
                <h5 class="breadcrumbs-title">User List</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Update or Delete Users.</p>
          <div class="divider"></div>
          <!--editableTable-->
          <div id="editableTable" class="section">
		  
            <div class="">
              <div class="col s12 m4 l3">
                <h4 class="header">List of users</h4>
              </div>
              <form action="" method="POST">
        <div style="display: flex; justify-content: space-between;">
        <input type="search" name="search" placeholder="Search by User Name" style="margin-right: 20px; width: 350px;margin-left: 20px;">
        
        <input type="text" name="address" placeholder="Search by Address" style="margin-left: 20px; width: 350px; margin-right: 20px;">
        <input type="submit" name="submit-btn" value="search" class="btn bg-danger white-text" style="margin-right: 5px;">
       </div> 
      </form><br>
              <div>
<table>
                    <thead>
                      <tr>
                        <th data-field="name">No:</th>
                        <th data-field="name">ID</th>
                        <th data-field="price">Name</th>
                        <th data-field="price">Email</th>
                        <th data-field="price">Password</th>	
                        <th data-field="price">Phone No</th>
                        <th data-field="price">Role</th>
                        <th data-field="price">Address</th>
                        <th data-field="price">Edit</th>
                        <th data-field="price">Delete</th>						
                      </tr>
                      <?php
                      $count=1;
                            foreach($data as $row):
                      ?>

                    </thead>

                    <tbody>
                      <tr>
                           <td>#<?php echo $count++;?></td>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['name'];?></td>
                           <td><?php echo $row['email'];?></td>
                           <td><?php echo $row['password'];?></td>
                           <td><?php echo $row['phone'];?></td>
                           <td><?php echo $row['role'];?></td>
                           <td><?php echo $row['address'];?></td>
                           <td><a href="update-user-data.php?rid=<?php echo $row['id'];?>" class="btn cyan waves-effect waves-light right white-text" style="margin-right: 50px;
                          width: 50%;">Update</a></td>
                           <td><a href="Delete-user-data.php?rid=<?php echo $row['id'];?>" class="btn cyan waves-effect waves-light right white-text" style="margin-right: 50px;
                          width: 50%;">Delete</a></td>
                      </tr>
                      
                    </tbody>
                    <?php
                       endforeach;
                    ?>
                  </table>

            <div class="divider"></div>
            
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
	<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    	
	
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
            },
            password: {
                required: true,
                minlength: 5,
            },
            name: {
                required: true,
                minlength: 5,
			},
            contact: {
                required: true,
                minlength: 4,
			},
            address: {
                minlength: 10,
			},		
            balance: {
                required: true,
			},				
		},
        messages: {
           username:{
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },	
           password:{
                required: "Provide a prove",
                minlength: "Password must be atleast 5 characters long",
            },	
           name:{
                required: "Please provide CVV number",
                minlength: "Enter at least 5 characters",		
            },	
           contact:{
                required: "Please provide card number",
                minlength: "Enter at least 4 digits",
            },	
           address:{
                minlength: "Address must be atleast 10 characters long",		
            },		
           balance:{
                required: "Please provide a balance.",		
            },				
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     }); 
    </script>
</body>

</html>
<?php
	// }
	// else
	// {
	// 	if($_SESSION['customer_sid']==session_id())
	// 	{
	// 		header("location:index.php");		
	// 	}
	// 	else{
	// 		header("location:login.php");
	// 	}
	// }
?>