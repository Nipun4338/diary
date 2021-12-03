<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
$sql="";
$sql="SELECT * FROM diary where user_id='$user_id' order by created_date desc";
$result=mysqli_query($link,$sql);
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
      array_push($data,$row);
  }
}

if(!empty($_GET["rating"]) || !empty($_GET["date"]))
{
  if(!empty($_GET["rating"]) && !empty($_GET["date"]))
  {
    if($_GET["rating"]=="ascending" && $_GET["date"]=="ascending")
    {
      $sql="SELECT * FROM diary where user_id='$user_id' order by rating, created_date";
    }
    else if($_GET["rating"]=="ascending" && $_GET["date"]=="descending")
    {
      $sql="SELECT * FROM diary where user_id='$user_id' order by rating, created_date desc";
    }
    else if($_GET["rating"]=="descending" && $_GET["date"]=="ascending")
    {
      $sql="SELECT * FROM diary where user_id='$user_id' order by rating desc, created_date";
    }
    else if($_GET["rating"]=="descending" && $_GET["date"]=="descending")
    {
      $sql="SELECT * FROM diary where user_id='$user_id' order by rating desc, created_date desc";
    }
  }
  $result=mysqli_query($link,$sql);
  $data=array();
  $noOfRows=mysqli_num_rows($result);
  if($noOfRows){
    while($row=mysqli_fetch_assoc($result)){
        array_push($data,$row);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Profile | Diary</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="card.css">
  <link rel="stylesheet" href="sidebar.css">
  </head>
  <body id="main">
    <?php
	include('includes/nav.php');
	 ?>
   <form action="" method="GET">
   <div id="mySidebar" class="sidebar">
     <a style="font-weight:bolder" class="devider">Filter</a>
    	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    	<a href="#">Rating</a>
      <div class="input-group mb-3" style="width: 90%;margin: 1em auto;">
      <select class="custom-select" id="rating" name="rating">
        <option selected value="ascending">Ascending</option>
        <option value="descending">Descending</option>
      </select>
    </div>
    	<a href="#">Created Date</a>
      <div class="input-group mb-3" style="width: 90%;margin: 1em auto;">
      <select class="custom-select" id="date" name="date">
        <option selected value="ascending">Ascending</option>
        <option value="descending">Descending</option>
      </select>
    </div>
    <div style="text-align:center">
      <button class="input-group mb-3 btn btn-info" style="width: 90%;margin: 1em auto;display: flex;
    align-items: center;
    justify-content: center;">Filter</button>
    </div>
  	</div>
  </form>
     <div class="col-md-3" id="" style="border-right: 3px solid #cecece">
       <div class="sidebar-item">
         <div class="sidenav">
					 <button id="openclose" class="openbtn sticky d-block fa fa-envelope-open" > Filter</button>
 				</div>
 			</div>
 		</div>
		<script type="text/javascript">
		$("a").on("click", function (e) {

	// Id of the element that was clicked
	var elementId = $(this).attr("id");
	if(elementId=="delete")
	{
		var r = confirm("Confirm delete?");
		if (r == true) {
			event.preventDefault();
			$.ajax({
				url:"delete_message.php",
				method:"POST",
				dataType:"json",
				success:function(data)
				{
					if(data.error != '')
			    {
					 $('input[type="submit"]').attr('disabled', true);
					 window.scrollTo(0, document.body.scrollHeight);
			    }
				}
			})
  } else {

  }
	}

});
		</script>
    <div class="container">

     <div class="row" style="display: flex;
align-items: stretch;
justify-content: space-around;">
       <?php
       if($noOfRows)
       {
       foreach ($data as $row1) {
        ?>
       <div class="card">
         <div class="container-fluid">
           <a href="read?id=<?php echo $row1['diary_id']?>">
           <div class="title">
             <?php echo $row1["diary_name"]; ?>
           </div>
           <div class="story ellipsis">
             <?php echo $row1["story"]; ?>
           </div>
           <div class="date">
             <?php echo date('M j, Y g:i A', strtotime($row1["created_date"])) ?>
           </div>
           <div class="rating">
             <?php echo $row1["rating"] ?>
           </div>
           </a>
         </div>
        </div>

         <?php } } ?>
     </div>
     </div>
   <script>
   function openNav() {
     document.getElementById("mySidebar").style.width = "250px";
     document.getElementById("main").style.marginLeft = "250px";
   }

   function closeNav() {
     document.getElementById("mySidebar").style.width = "0";
     document.getElementById("main").style.marginLeft= "0";
   }
   </script>
   <script>
$(document).ready(function(){
  $('#openclose').click(function() {
		if($('#openclose').hasClass('fa-envelope-open'))
		{
			openNav();
			$('#openclose').removeClass('fa-envelope-open');
			$('#openclose').addClass('fa-envelope');
		}
		else if($('#openclose').hasClass('fa-envelope')){
			closeNav();
			$('#openclose').removeClass('fa-envelope');
			$('#openclose').addClass('fa-envelope-open');
		}
	});

});

</script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
