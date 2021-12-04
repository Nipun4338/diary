
<nav class = "navbar navbar-expand-lg navbar-light bg-light sticky-top shadow p-3 mb-5 bg-white rounded">

	 <div class="container-fluid">
	 <a href="profile" class = "navbar-brand" style="font-weight:bold;">
			Diary
	</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	</button>
	 <div class="collapse navbar-collapse" id="navbarSupportedContent">
	 <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="padding: 0px 5px 0px 5px;font-weight:bold">
			 <a class="nav-item nav-link" href = "profile"> Home </a>
			 <a class="nav-item nav-link" href = "addnew"> Add New </a>
			 <a class="nav-item nav-link" href = "posts"> Public Posts </a>
			 <?php if (!isset($_SESSION["username"])) {
    		$message= '<a class="nav-item nav-link" href = "login"> LOGIN </a>';
			}
			else {
				$message='<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          '.$_SESSION['user_name'].'
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile">Profile</a>
					<a class="dropdown-item" href="addnew">Add New Story</a>
					<a class="dropdown-item" href="wishlist">Wishlist</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" name="logout_btn" href="logout">Logout</a>
        </div>';
			}
			echo ($message);?>
	 </ul>
 </div>
</div>
 </nav>
