<?php include('links/dashboard/header.php');?>

	<div class="User_dashobard_main_body">
		<div class="head">
			<div class="heading">
				<h1>Refaral Program</h1>
			</div>
			<div class="button">
				<a href="#" class="btn"><i class="fal fa-users-class"></i> View Refaral Program</a>
			</div>
		</div>

		<div class="wallet_details_sections">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="wallet_details_cash_transaction">
						<h3>My Refaral Program</h3>
						<div class="filter">
							<form>
								<div class="row">
									<div class="form-group col-lg-3 col-md-6 col-sm-12">
										<label>Form</label>
										<input type="date" class="form-control" name="">
									</div>
									<div class="form-group col-lg-3 col-md-6 col-sm-12">
										<label>To</label>
										<input type="date" class="form-control" name="">
									</div>
									<div class="col-lg-2 mt-auto">
										<button class="thm-btn" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<div class="table-responsive custom_scroll">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Date</th>
										<th>Package</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Demo User</td>
										<td>April 09, 2024</td>
										<td>Silver</td>
										<td>$50.00</td>
									</tr>
									<tr>
										<td>Demo User</td>
										<td>April 09, 2024</td>
										<td>Gold</td>
										<td>$500.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php include('links/dashboard/footer.php');?>