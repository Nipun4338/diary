<?php
include('database/dbconfig.php');
$query="Select * from diary where diary_id='45'";
$result=mysqli_query($connection,$query);
$data=array();


  while($row=mysqli_fetch_assoc($result)){
      array_push($data,$row);
  }

  foreach ($data as $row1) {
    echo $row1["story"];
  }
?>
