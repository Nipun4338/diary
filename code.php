<?php
include("security.php");
include('database/dbconfig.php');

if (isset($_POST["login"])) {
    $email_login=$_POST['email'];
    $password_login=md5($_POST['password']);
    $query="select * from user where email='".$email_login."' and password='".$password_login."'";
    $query_run=mysqli_query($connection, $query);
    $data=array();
    $noOfRows=mysqli_num_rows($query_run);
    $id=0;
    if(mysqli_num_rows($query_run) > 0)
    {
      $flag=0;
      while($row=mysqli_fetch_assoc($query_run)){
          $id=$row['user_id'];
          array_push($data,$row);
          $flag=1;
      }
      if($flag==1)
      {
        $_SESSION['username']=$email_login;
        $_SESSION['user_id']=$id;
        foreach ($data as $row) {
          // code...
          $name=$row["name"];
          $_SESSION['user_name']=$name;
        }
        header('Location: profile');
      }
      else {
        $_SESSION['status']="Email id / Password is invalid";
        header('Location: login');
      }
    }
    else {
      $_SESSION['status']="Email id / Password is invalid";
      header('Location: login');
    }
  }

?>
