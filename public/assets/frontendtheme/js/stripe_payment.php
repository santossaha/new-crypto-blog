	<?php include('header.php'); ?>
	<?php //include("connection.php"); ?>
	<?php
	
	/*print "<pre>";
	print_r($_POST);
	var_dump($_POST);
	die;*/

	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty

	if(!empty($_POST['stripeToken']))
	{

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['holdername'];
		$email = $_POST['email'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];

		// Get Product ID From - Form
		$productId = $_POST['productId'];

		// Get Product Details By Using Product-Id
		$SQL_getPr = "SELECT * FROM `service` WHERE `id`='$productId'";
	    $res_getPr = mysqli_query($conn,$SQL_getPr) or die("MySqli Query Error".mysqli_error($conn));
	    $row_getPr = mysqli_fetch_assoc($res_getPr);
	    $price = $row_getPr['price'];
	    $pr_desc = $row_getPr['name'];

		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51NVHNyJxuTMrcVHjlDbe7WfmiPIrMrLBgBngLbe17GjivLogDwhe0ZNOv8TrdRS2cbU4U02Thsy6ynC7FVThicpR0070LMfqkf",
		"PublishableKey"=>"pk_test_51NVHNyJxuTMrcVHjxfmeQyBlS9068NBYXF2zyzNagR1oXhLgC5THbhxhqXvB6t5pfTyyndHRbg3XAIwo4CmoSSE700UJKyc5fG"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$pr_desc
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = ($price*100);
	    $currency = "usd";
	    $itemName = $row_getPr['name'];

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $itemName, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['balance_transaction']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database
	       $sql = "INSERT INTO `orders`(`name`,`email`,`card_number`,`card_exp_month`,`card_exp_year`,`item_name`,`item_number`,`item_price`,`item_price_currency`,`paid_amount`,`paid_amount_currency`,`txn_id`,`payment_status`,`created`,`modified`) VALUES ('$name','$email','$card_no','$card_exp_month','$card_exp_year','$itemName','','$itemPrice','$currency','$paidAmount','$paidCurrency','$transactionID','$payment_status','$dt_tm','$dt_tm')";
	       
	        mysqli_query($conn,$sql) or die("Mysqli Error Stripe-Charge(SQL)".mysqli_error($conn));
    		//Get Last Id
    		$sql_g = "SELECT * FROM `orders`";
    		$res_g = mysqli_query($conn,$sql_g) or die("Mysql Error Stripe-Charge(SQL2)".mysqli_error($conn));
    		while($row_g=mysqli_fetch_assoc($res_g)){
    			$id = $row_g['id'];
    		}

	        // If the order is successful 
	        if($payment_status == 'succeeded')
	        { 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} 
	else{ 
	   $statusMsg = "Error on form submission."; 
	    
	} 
	// if (isset($_GET['reload'])) {
 //     echo '<meta http-equiv=Refresh content="0;url=our-services.php">';
	// }
	?>
	
		<!-- Title Bar -->
		<?php
           $sql=mysqli_query($conn,"select * from information where id= '27' ");
           $result=mysqli_fetch_assoc($sql);
         ?>
         
		<!-- Title Bar End-->

		<!-- Page Content -->
		<div class="page-content" style="margin-top: 150px;">

            <!-- Visa Details --> 
            <section class="visa-details-section">
				<div class="container">
					<div class="row">
					 <div class="col-lg-12">
						<div class="status">
							<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
						
							<h4 class="heading">Payment Information - </h4>
							<br>
							<p><b>Reference ID:</b> <strong><?php echo $id; ?></strong></p>
							<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
							<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?> ($<?php echo $price;?>.00)</p>
							<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
							<h4 class="heading">Product Information - </h4>
							<br>
							<p><b>Name:</b> <?php echo $itemName; ?></p>
							<p><b>Price:</b> <?php echo $itemPrice.' '.$currency; ?> ($<?php echo $price;?>.00)</p>
						</div>
						<a href="index.php" class="btn btn-success">Back to Home</a>
					</div>
					</div>
				</div>


				</div>
            </section>
            <!-- Visa Details End -->

		</div>
		<!-- Page Content End -->

	<?php include('footer.php'); ?>
