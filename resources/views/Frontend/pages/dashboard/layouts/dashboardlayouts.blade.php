<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Dashboard</title>

	<link rel="icon" type="image/x-icon" href="{{url('/')}}/assets/frontendtheme/dashboard/img/logo/favicon.jpg">

	<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/frontendtheme/dashboard/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

	<link rel="stylesheet" href="{{url('/')}}/assets/frontendtheme/dashboard/css/fontawesome.min.css" >

	<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/frontendtheme/dashboard/css/dashboard.css">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>


	<nav class="navbar">
		<div class="container-fluid w-100 px-sm-0">
			<div class="row navs justify-content-between align-items-center w-100">
				<div class="col-lg-2 col-md-2 col-sm-6 col-6">
					<div class="navbar_brands_logo">
						<a href="dashboard.php">
							<img src="{{url('/')}}/assets/frontendtheme/dashboard/img/logo/logo-b.png">
						</a>
					</div>
				</div>
				<div class="col-lg-5 col-md-6 d-none d-md-block">
					<div class="navbar_brands_search">
						<form>
							<div class="search">
								<input type="text" class="form-control" name="" placeholder="Search ....">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 col-6">
					<div class="navbar_user_signout">
						<a href="profile.php" class="link"><i class="far fa-user"></i> <span>Hi, Amar</span></a>
						<a href="login.php" class="thm-btn"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a>
						<a href="javascript:;" onclick="openSidebar()" class="link d-inline-block d-md-none"><i class="fa fa-bars"></i></a>
					</div>
				</div>
			</div>
		</div>
	</nav>


	<div class="User_dashobard_main">
		<div class="container-fluid px-0">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-sm-12 px-lg-0">
					<div class="User_dashobard_main_nav" id="sideNavBar">
						<a href="javascript:;" onclick="closeSidebar()" class="close d-block d-md-none"><i class="fa fa-times"></i></a>
						<a href="profile.php" class="btn"><i class="far fa-user"></i> Edit your profile</a>
						<div class="links">
							<ul>
								<li><a href="dashboard.php" class="active"><i class="fal fa-gauge"></i> Dashboard</a></li>
								<li><a href="profile.php"><i class="fal fa-user"></i> Profile</a></li>
								<li><a href="my-courses.php"><i class="fal fa-user-graduate"></i> Courses</a></li>
								<li><a href="my-video.php"><i class="far fa-video"></i> Videos</a></li>
								<li><a href="my-class-recording.php"><i class="far fa-video-plus"></i> Class Recording</a></li>
								<li><a href="my-referance.php"><i class="fal fa-users"></i> Referance</a></li>
								<li><a href="my-refaral-program.php"><i class="fal fa-users-class"></i> Refaral Program</a></li>
								<li><a href="login.php"><i class="fal fa-sign-out"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-10 col-md-9 col-sm-12 px-lg-0">
									

                    @yield('content')


                    				
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="{{url('/')}}/assets/frontendtheme/dashboard/js/jquery-3.6.0.min.js"></script>

	<script type="text/javascript" src="{{url('/')}}/assets/frontendtheme/dashboard/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>

<script type="text/javascript">
	function openSidebar(){
		document.getElementById('sideNavBar').style.display="block";
	}
	function closeSidebar(){
		document.getElementById('sideNavBar').style.display="none";
	}
</script>