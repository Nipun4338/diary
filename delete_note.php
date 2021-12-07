<?php
include("security.php");
include('database/dbconfig.php');
$delete=$_SESSION['delete'];
$user_id=$_SESSION['user_id'];
$query = "Delete from diary where user_id='".$user_id."' and diary_id='".$delete."'";
$statement = $connection->prepare($query);
$statement->execute();
$error = '';
$error = '<p class="text-danger">Note Deleted.</p>';
$data = array(
 'error'  => $error
);
echo json_encode($data);
?>
