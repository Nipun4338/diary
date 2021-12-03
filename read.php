<?php
include('database/dbconfig.php');
$user_id="";
if(isset($_SESSION['user_id']))
{
  $user_id=$_SESSION['user_id'];
}
if(!empty($_GET["id"])){
  $diary_id=$_GET["id"];
}
else {
  $diary_id="error";
}
$sql="SELECT * FROM diary where diary_id='$diary_id'";
$result=mysqli_query($link,$sql);
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
      array_push($data,$row);
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Read | Diary</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="card2.css">
  </head>
  <body>
    <?php
	include('includes/nav.php');
	 ?>
   <?php
   if($noOfRows)
   {
   foreach ($data as $row1) {
     if($row1["diary_status"]=="public" || $row1["user_id"]==$user_id)
     {
    ?>
    <div class="container-fluid">
    <div class="card">
      <div class="date">
        <?php echo date('M j, Y g:i A', strtotime($row1["created_date"])) ?>
      </div>
        <div class="title">
          <?php echo html_entity_decode(nl2br($row1["diary_name"])); ?>
        </div>
        <div class="rating">
          Rating: <?php echo $row1["rating"]; ?>
        </div>
        <div class="story" style="left:0">
          <?php echo html_entity_decode(nl2br($row1["story"])); ?>
        </div>
        <div class="privacy">
          Privacy: <?php echo $row1["diary_status"]; ?>
        </div>
        <div class="date2">
          Last Modified: <?php echo date('M j, Y g:i A', strtotime($row1["modified_date"])) ?>
        </div>
      <?php
        if($row1["user_id"]==$user_id)
        { ?>
          <button style="position: relative;margin-top:15px;" type="button" class="btn btn-info" onclick="document.location='edit?id=<?php echo $row1['diary_id'];?>'" name="edit">EDIT</button>
      <?php  }
       ?>
      </div>
      </div>
    <?php }
    else {
      echo '<h6 class="bg-danger text-white" style="text-align:center"> Unauthorized attempt! </h6>';
    }
   } }
    else {
      echo '<h6 class="bg-danger text-white" style="text-align:center"> Something went wrong! </h6>';
    } ?>
  </body>
</html>
