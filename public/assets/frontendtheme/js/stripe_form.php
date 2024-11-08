	<?php include('header.php');
	if(isset($_GET['id']))
	{
       $productId = $_GET['id'];
    } 
    else {
    	
        $productId = '';
    }

    $sql=mysqli_query($conn, "select * from service where id='".$productId."'");
    $result=mysqli_fetch_assoc($sql);
    $price = $result['price'];
    $product_name = $result['name'];
	?>
		<!-- Title Bar -->
		<?php
	       $sql=mysqli_query($conn,"select * from information where id= '27' ");
	       $result=mysqli_fetch_assoc($sql);
	     ?>
         <div class="pbmit-title-bar-wrapper" style="background-image: url(images/<?php echo $result['data']; ?>);">
			<div class="container">
				<div class="pbmit-title-bar-content">
					<div class="pbmit-title-bar-content-inner">
					    	<?php
                                $sql12=mysqli_query($conn, "select * from service where id='".$_GET['id']."' ");
					            $service=mysqli_fetch_assoc($sql12);
					       ?>     
					    
						<div class="pbmit-tbar">
							<div class="pbmit-tbar-inner container">
								<h1 class="pbmit-tbar-title"> <?=$service['name']?> </h1>
							</div>
						</div>
						<div class="pbmit-breadcrumb">
							<div class="pbmit-breadcrumb-inner">
								<span><a title="" href="index.php" class="home"><i class="fa fa-home"></i></a></span>
								<span class="sep">  →  </span>
								<span><a title="" href="our-services.php" class="home"> Services</a></span>
								<span class="sep">  →  </span>
								<span><span class="post-root post post-post current-item"> <?=$service['name']?></span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Title Bar End-->
		
		<link rel="stylesheet" href="css/style-stripe.css">
		<!-- Page Content -->
		<div class="page-content">

            <!-- Visa Details --> 
            <section class="visa-details-section">
				<div class="container">
					<div class="col-lg-12  order-1" style="margin-top: 25px;">
							<div class="pbmit-service-single-content">
							<div class="panel">
						   <div class="panel-heading">
						      <h3 class="panel-title">Charge $<?php echo $price; ?> with Stripe</h3>
						      <!-- Product Info -->
						      <p><b>Item Name:</b> <?php echo  $product_name; ?></p>
						      <p><b>Price:</b> $<?php echo $price; ?> USD</p>
						   </div>
						   <div class="panel-body">
						      <!-- Display status message -->
						       <!-- Display errors returned by createToken -->
		                        <div class="payment-status" style="color: red;"></div>
						      <!-- Display a payment form -->
						      <form class="block" action="stripe_payment.php" method="POST" name="cardpayment" id="payment-form">
						      	 <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
						         <div class="form-group">
						            <label>NAME</label>
						            <input type="text" class="form-control" name="holdername" placeholder="Enter Card Holder Name" autofocus required id="name"ocus="">
						         </div>
						         <div class="form-group">
						            <label>EMAIL</label>
						            <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
						         </div>
						        <div class="form-group">
						            <label>CARD NUMBER</label>
						            <div class="input-group">
                                    <input style="border: 1px solid rgba(119,119,119,.2);" type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                	</div>
						        </div>
						         <div class="row">

		                                    <div class="col-xs-4 col-md-4">
		                                        <div class="form-group">
		                                            <label for="cardExpiry"><span class="visible-xs-inline">MON</span></label>
		                                            <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
		                                                <option>MON</option>
		                                                <option value="01">01 ( JAN )</option>
		                                                <option value="02">02 ( FEB )</option>
		                                                <option value="03">03 ( MAR )</option>
		                                                <option value="04">04 ( APR )</option>
		                                                <option value="05">05 ( MAY )</option>
		                                                <option value="06">06 ( JUN )</option>
		                                                <option value="07">07 ( JUL )</option>
		                                                <option value="08">08 ( AUG )</option>
		                                                <option value="09">09 ( SEP )</option>
		                                                <option value="10">10 ( OCT )</option>
		                                                <option value="11">11 ( NOV )</option>
		                                                <option value="12">12 ( DEC )</option>
		                                            </select>
		                                        </div>
		                                    </div>

		                                    <div class="col-xs-4 col-md-4">
		                                        <div class="form-group">
		                                            <label for="cardExpiry"><span class="visible-xs-inline">YEAR</span></label>
		                                            <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year">
		                                                <option>Year</option>
		                                                <option value="24">2024</option>
		                                                <option value="25">2025</option>
		                                                <option value="26">2026</option>
		                                                <option value="27">2027</option>
		                                                <option value="28">2028</option>
		                                                <option value="29">2029</option>
		                                                <option value="30">2030</option>
		                                                <option value="31">2031</option>
		                                                <option value="32">2032</option>
		                                                <option value="33">2033</option>
		                                                <option value="34">2034</option>
		                                                <option value="35">2035</option>
		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="col-xs-4 col-md-4 pull-right">
		                                        <div class="form-group">
		                                            <label for="cardCVC">CV CODE</label>
		                                            <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
		                                        </div>
		                                    </div>
		                                </div>

							         <!-- Form submit button -->
							        <button id="submitBtn" type="submit" class="btn btn-success subscribe" id="payBtn">
							            <div class="spinner hidden" id="spinner"></div>
							            <span id="buttonText">Pay Now ( $<?php echo $price;?> )</span>
							         </button>
							      </form>
						      <!-- Display processing notification -->
						   </div>
						</div>	
							</div>
							</div>
				</div>
		</div>
            </section>
            <!-- Visa Details End -->

		</div>
		<!-- Page Content End -->

	<?php include('footer.php'); ?>
	<script src="https://js.stripe.com/v2/"></script>
	<script>
        // Set your publishable key
        Stripe.setPublishableKey('pk_test_51NVHNyJxuTMrcVHjxfmeQyBlS9068NBYXF2zyzNagR1oXhLgC5THbhxhqXvB6t5pfTyyndHRbg3XAIwo4CmoSSE700UJKyc5fG');

        /*$(function() {
            var $form = $('#payment-form');
            $form.submit(function(event) {
                // Disable the submit button to prevent repeated clicks:
                $form.find('.submit').prop('disabled', true);
                // Request a token from Stripe:
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from being submitted:
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            // Grab the form:
            var $form = $('#payment-form');

            if (response.error) { // Problem!
                // Show the errors on the form:
                $form.find('.payment-status').text(response.error.message);
                $form.find('.submit').prop('disabled', false); // Re-enable submission
            } else { // Token was created!
                // Get the token ID:
                var token = response.id;
                // Insert the token ID into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken">').val(token));
                // Submit the form:
                $form.get(0).submit();
            }
        };*/

        // Callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // Enable the submit button
                $('#payBtn').removeAttr("disabled");
                // Display the errors on the form
                $(".payment-status").html('<p>'+response.error.message+'</p>');
            } else {
                var form$ = $("#payment-form");
                // Get token id
                var token = response.id;
                // Insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // Submit form to the server
                form$.get(0).submit();
            }
        }

        $(document).ready(function() {
            // On form submit
            $("#payment-form").submit(function() {
                // Disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");
                
                // Create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_number').val(),
                    exp_month: $('#card_exp_month').val(),
                    exp_year: $('#card_exp_year').val(),
                    cvc: $('#card_cvc').val()
                }, stripeResponseHandler);
                
                // Submit from callback
                return false;
            });
        });
</script>