<?php include('links/dashboard/header.php');?>

	<div class="User_dashobard_main_body">
		<div class="head">
			<div class="heading">
				<h1>Edit Profile</h1>
			</div>
			<div class="button">
				<a href="profile.php" class="btn"><i class="far fa-user"></i> View Profile</a>
			</div>
		</div>
		<div class="User_profile_body_content_main">
			<div class="row">
				<div class="col-lg-4">
					<div class="User_profile_body_content_info">
						<div class="item_one">
							<div class="user">
								<img src="assets/img/profile/user.jpg">
							</div>
							<h4>Amar Mandal</h4>
							<span>Project Manager</span>
							<div class="dec">
								<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="User_profile_body_content_data_edit">
						<h3>Profile Information</h3>
						<form>
							<div class="row">
								<div class="form-group col-lg-12 col-md-12">
									<label>Name</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>Phone Number</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>Email ID</label>
									<input type="email" name="" class="form-control">
								</div>
								<div class="form-group col-lg-12 col-md-12">
									<label>Address</label>
									<textarea class="form-control" name="" rows="3" cols="35"></textarea>
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>Company Name</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>User ID</label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>Password</label>
									<input type="password" name="" class="form-control">
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label>Confirm Password</label>
									<input type="password" name="" class="form-control">
								</div>
								<div class="form-group col-lg-12 col-md-12">
									<label>Add Prifile Picture</label>
									<input type="file" name="" class="form-control" style="padding: 12px 20px;">
								</div>
								<div class="form-group col-lg-12 col-md-12">
									<label>Add Notes</label>
									<textarea class="form-control" name="" rows="3" cols="35"></textarea>
								</div>
								<div class="col-lg-12">
									<button class="thm-btn" name="" type="submit">Save Change</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php include('links/dashboard/footer.php');?>