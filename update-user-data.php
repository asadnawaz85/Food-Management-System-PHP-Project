<?php
include "connection.php";
session_start();
if($_SESSION['role']!="Admin"):
  header("location:login.php");
exit();
endif; 

// session_start(); 
// if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']))
// {
// 	header("location:index.php");
// }
// else{
if (isset($_GET['rid'])) 
        {

                $id = $_GET['rid'];
             

             $querry = "SELECT * FROM registration WHERE id = $id ";
             $querry_result = mysqli_query($conn_resul,$querry);

             if ($querry_result->num_rows > 0)
              {
                $actual_data = mysqli_fetch_assoc($querry_result);

             }

        }


        if (isset($_POST['submit'])) 
        {
            
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $phone=$_POST['phone'];
            $role=$_POST['role'];
            $address=$_POST['address'];
            echo "<pre>";
            

            
            $querry2 = "UPDATE registration SET name = '$name', email = '$email', password = '$password',phone='$phone',role='$role',address='$address' 
                        WHERE id = $id

            ";


            $querry_res = mysqli_query($conn_resul,$querry2);
            header("Location: users.php");
            exit;
            

        }
    //     if($actul_data['role']=="Admin"){
    //   header("location:index.php");
    // }
    // else

    // {
    //   header("location:login.php");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Register</title>

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
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

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

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="formValidate" id="formValidate" method="POST" action="" novalidate="novalidate" class="col s12">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Update Data!</h4>
            <p class="center">Update now!</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input name="name" id="username" type="text" value="<?php  echo $actual_data['name']; ?>">
            <label for="username" class="center-align">Username</label>
			<div class="errorTxt1"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input name="email" id="name" type="email" value="<?php  echo $actual_data['email']; ?>">
            <label for="name" class="center-align">Email</label>
			<div class="errorTxt2"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="password" id="password" type="password" value="<?php  echo $actual_data['password']; ?>">
            <label for="password">Password</label>
			<div class="errorTxt3"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input name="phone" id="phone" type="number" data-error=".errorTxt4" value="<?php  echo $actual_data['phone']; ?>">
            <label for="phone">Phone</label>
			<div class="errorTxt4"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12" style="padding-left: 50px;">
            <!-- <i class="mdi-social-person-outline prefix" style="position: absolute;margin-right: 20px;"></i> -->
            <select name="role">
              <option>Select Role</option>
              <option value="Admin"
              <?php  if($actual_data['role']=='Admin')
              {
                echo "selected";
              }; ?>
              >Admin</option>
              <option value="User"
              <?php  if($actual_data['role']=='User')
              {
                echo "selected";
              }; ?>>User</option>
            </select>
            
            <label for="Role" style="padding-left:40px;">Select Role</label>
      <div class="errorTxt4"></div>     
          </div>
        </div>   
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-home prefix"></i>
            <input name="address" id="phone" type="text" data-error=".errorTxt4" value="<?php  echo $actual_data['address']; ?>">
            <label for="phone">Address</label>
      <div class="errorTxt4"></div>     
          </div>
        </div> 		
        <div class="row">
          <div class="input-field col s12">
			<input type="submit" name="submit" value="Update" class="btn waves-effect waves-light col s12">
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account?</p>
          </div>
        </div>
      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
     <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
     
      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    
</body>
</html>
<!-- <?php
//}
?> -->