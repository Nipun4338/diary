<?php
include("security.php");
include('database/dbconfig.php');

if (isset($_POST["save"])) {
    $user=$_SESSION['user_id'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $title=htmlspecialchars($_POST["title"]);
    $note=htmlspecialchars($_POST["noteInput"]);
    $rating=$_POST["rating"];
    $privacy=$_POST["privacy"];
    $query = sprintf("INSERT INTO diary (user_id,diary_name,story,rating,created_date,modified_date,diary_status)
    VALUES ('$user','$title','$note','$rating','$datetime','$datetime','$privacy')",
    mysqli_real_escape_string($connection, $note));
    $query_run = mysqli_query($connection, $query);

    $new_note = mysqli_insert_id($connection);
    if($query_run)
    {
      header('Location: read?id='.$new_note);
    }
  }

?>
