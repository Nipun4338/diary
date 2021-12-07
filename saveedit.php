<?php
include("security.php");
include('database/dbconfig.php');

if (isset($_POST["editsave"])) {
    $user=$_SESSION['user_id'];
    $diary_id=$_POST["edit_diary_id"];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $title=htmlspecialchars($_POST["title"]);
    $note=htmlspecialchars($_POST["noteInput"]);
    $rating=$_POST["rating"];
    $privacy=$_POST["privacy"];
    $query = sprintf("Update diary set diary_name='".$title."', story='".$note."', rating='".$rating."', diary_status='".$privacy."', modified_date='".$datetime."' where diary_id='".$diary_id."'",
    mysqli_real_escape_string($connection, $note));
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
      header('Location: read?id='.$diary_id);
    }
  }

?>
