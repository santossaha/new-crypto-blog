@extends('Frontend.layouts.frontendlayouts')

@section('content')

<section class="visa-details-section">
    <div class="container">
        <div class="col-lg-12  order-1" style="margin-top: 25px;">
                <div class="pbmit-service-single-content">
                <div class="panel">
               <div class="panel-heading">
                  <h3 class="panel-title">Charge $<?php echo $price; ?> with Stripe</h3>
                  <!-- Product Info -->
                  <p><b>Item Name:</b> <?php echo $product_name; ?></p>
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



@endsection