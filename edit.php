<?php
include("security.php");
include('database/dbconfig.php');

$user_id=$_SESSION['user_id'];
if(!empty($_GET["id"])){
  $diary_id=$_GET["id"];
}
else {
  $diary_id="error";
}
$sql="SELECT * FROM diary where user_id='".$user_id."' and diary_id='".$diary_id."'";
$result=mysqli_query($connection,$sql);
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="note.css">
  <link rel="icon" href="Graphicloads-Colorful-Long-Shadow-Diary.ico">
  </head>
  <body>
    <?php
	include('includes/nav.php');
	 ?>
   <?php
    if($noOfRows)
    {
      foreach ($data as $row1) {
    ?>
    <DIV CLASS="time">
      <P ID="time">--:--:-- --</P>
    </DIV>
    <div class="notepad-container">
    <form action="saveedit.php" method="POST">
    <input type="hidden" name="edit_diary_id" value="<?php echo $diary_id?>">
    <input style="width: 90%;
      display: block;
      margin: 0 auto;
      padding: 10px;" type="text" class="form-control" placeholder="Title (optional)" value="<?php echo $row1["diary_name"]; ?>" name="title">
    <textarea class="input" rows="10" cols="10" name='noteInput' required><?php echo $row1["story"]; ?></textarea>
    <div class="input-group mb-3" style="width: 90%;margin: 1em auto;">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Rate</label>
        </div>
        <select class="custom-select" id="rating" name="rating">
          <option selected value="<?php echo $row1["rating"]; ?>"><?php echo $row1["rating"]; ?></option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
    </div>
    <div class="input-group mb-3" style="width: 90%;margin: 1em auto;">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect02">Privacy</label>
        </div>
        <select class="custom-select" id="privacy" name="privacy">
          <option selected value="<?php echo $row1["diary_status"]; ?>"><?php echo $row1["diary_status"]; ?></option>
          <option value="private">Private</option>
          <option value="public">Public</option>
        </select>
    </div>
    <!-- Save note and append to list --><button name="editsave" id="save">Save Edit</button>
  </div>
</form>
    <?php
    }
  }
    else {
      echo '<h6 class="bg-danger text-white" style="text-align:center"> Something went wrong! </h6>';
    }
    ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script><script  src="./script.js"></script>
 </body>
 </html>
