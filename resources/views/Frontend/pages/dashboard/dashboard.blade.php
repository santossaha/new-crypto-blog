
@extends('Frontend.pages.dashboard.layouts.dashboardlayouts')

@section('content')

	<div class="User_dashobard_main_body">
		<div class="head">
			<div class="heading">
				<h1>Hi, Amar</h1>
			</div>
			<div class="button">
				<a href="profile.php" class="btn"><i class="far fa-user"></i> View Profile</a>
			</div>
		</div>
		<div class="User_dashobard_contents">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="User_dashobard_contents_item one">
						<div class="conts">
							<i class="fal fa-user"></i>
							<h1>Profile</h1>
							<a href="profile.php">View Profile <i class="far fa-arrow-right"></i></a>
						</div>
						<img src="assets/img/graph/03.png">
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="User_dashobard_contents_item two">
						<div class="conts">
							<i class="fal fa-user-graduate"></i>
							<h1>Courses</h1>
							<a href="my-courses.php">View Courses <i class="far fa-arrow-right"></i></a>
						</div>
						<img src="assets/img/graph/03.png">
					</div>
				</div>
				


				
			</div>
		</div>
	</div>


@endsection
