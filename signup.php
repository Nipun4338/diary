<?php session_start(); ?>
<?php
include('database/dbconfig.php');
$success_message='';
date_default_timezone_set("Asia/Dhaka");
$datetime = '';
    if(isset($_REQUEST['submit']))
     {
			 $datetime=date('Y-m-d H:i:s');
			 $user_email=$_POST["email"];
			 $user_name=$_POST["name"];
			 $user_password=md5($_POST["password"]);
			 $sqlCheck='select * from user where email="'.$user_email.'"';
			 $result=mysqli_query($link,$sqlCheck);
			 $noOfRows=mysqli_num_rows($result);
			 if($noOfRows)
			 {
 					$success_message = "Already Registered!!";
			 }
			 else {
				 $sqlInsert='insert into user(name,email,password,created_date)
				 values("'.$user_name.'","'.$user_email.'","'.$user_password.'","'.$datetime.'")';
				 $resultInsert=mysqli_query($link, $sqlInsert);
				$success_message = 'Successfully Registered!';
			 }
    }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale = 1.0">
     <title>Diary</title>
     <script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <section class="container">
         	<section class="row justify-content-right">
         		<section class="col-md-12">
               <?php if($success_message != '' && $success_message!="Already Registered!!")
                     {
                         echo '
                         <div class="alert alert-success" style="margin-top: 15px; text-align: center">
                         '.$success_message.'
                         </div>
                         ';
                     }
                     else {
                       echo '
                       <div class="alert alert-danger" style="margin-top: 15px; text-align: center">
                       '.$success_message.'
                       </div>
                       ';
                     }?>
         			<form class="form-container" action="" method="POST" enctype="multipart/form-data">
                 <div class="form-group mb-3">
                   <h2 style="text-align:center"><b>Sign Up</b></h2>
                   <label>Name</label>
                   <input type="text" name="name" value="" placeholder="Enter your name" class="form-control" required />
                 </div>
                 <div class="form-group mb-3">
                   <label>Email</label>
                   <input type="email" name="email" value="" placeholder="Enter your email (must be unique)" class="form-control" required />
                 </div>
                 <div class="form-group mb-3">
                   <label>Password</label>
                   <input type="password" id="password"  name="password" value="" placeholder="Enter your password" class="form-control" required />
                 </div>
                 <div class="form-group mb-3">
                   <label>Confirm Password</label>
                   <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Retype Password" class="form-control" required />
                   <span id='message'></span>
                 </div>
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                 <script>
                 $('#password, #confirm_password').on('keyup', function () {
                   if ($('#password').val() == $('#confirm_password').val()) {
                     $('#message').html('Matching').css('color', 'green');
                   } else
                     $('#message').html('Not Matching').css('color', 'red');
                 });
                 </script>
         			  <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary btn-block submit2">Submit</button>
     						<a href="login" style="float: right">Not New?</a>
         			</form>
   					</section>
         	</section>
         </section>
         </div>
         </div>
         </div>
   </body>
 </html>
