@extends('Frontend.layouts.frontendlayouts')

@section('content')


	
		
		<div class="pbmit-title-bar-wrapper" style="background-image: url({{url('/')}}/assets/frontendtheme/images/title-bg.jpg);">
            <div class="container">
				<div class="pbmit-title-bar-content">
					<div class="pbmit-title-bar-content-inner">
						<div class="pbmit-tbar">
							<div class="pbmit-tbar-inner container">
								<h1 class="pbmit-tbar-title"> Asylum Questionnaire</h1>
							</div>
						</div>
						<div class="pbmit-breadcrumb">
							<div class="pbmit-breadcrumb-inner">
								<span><a title="" href="" class="home"><i class="fa fa-home"></i></a></span>
								<span class="sep">  →  </span>
								<span><span class="post-root post post-post current-item"> Asylum Questionnaire</span></span>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>


        <!-- Page Content -->
		<div class="page-content demo-one">


			<div class="pb-5">
				<div class="container">
				  <div class="row">
				    <div class="col-md-8 mx-auto">
				      <div class="card mt-5">
				        <div class="card-header">
				          <h4>Asylum Form</h4>
				        </div>
				        <div class="card-body">
				        	<form action="" method="">
					            <div class="row mb-3">
					              <div class="col">
					                <input type="text" class="form-control" placeholder="First Name" name="fname">
					              </div>
					              <div class="col">
					                <input type="text" class="form-control" placeholder="Middle Name" name="mname">
					              </div>
					              <div class="col">
					                <input type="text" class="form-control" placeholder="Last Name" name="lname">
					              </div>
					            </div>
					            <div class="mb-3">
					              <input type="email" class="form-control" placeholder="Email" name="email">
					            </div>
					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Alien Number if any A-" name="anumber">
					            </div>
					            <div class="mb-3">
					              <textarea class="form-control" rows="2" placeholder="Home Address" name="haddress"></textarea>
					            </div>
					            <div class="mb-3">
					              <input type="tel" class="form-control" placeholder="Phone Number" name="pnumber">
					            </div>
					            <div class="mb-3">
					            <input type="tel" class="form-control" placeholder="Mailing Address if different from the home address"
					             name="maddress" >
					            </div>
					            <div class="mb-3">            

					              <h6>Are You ?</h6>
					              <div class="form-check-inline">
					              <label class="container1">Married
					                <input type="radio" checked="checked" name="relationship" value="married" >
					                <span class="checkmark1"></span>                
					                </label>
					                </div>
					                <div class="form-check-inline">
					                <label class="container1">Single
					                <input type="radio" name="relationship" value="single">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					                <div class="form-check-inline">
					                <label class="container1">Divorsed
					                <input type="radio" name="relationship" value="divorsed">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					                <div class="form-check-inline">
					                <label class="container1">Other
					                <input type="radio" name="relationship" value="other">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					                
					            </div>
					          

					            <div class="mb-3">            

					                <h6>Your Gender ?</h6>
					                <div class="form-check-inline">
					                <label class="container1">Feminine
					                <input type="radio" checked="checked" name="gender" value="Feminine">
					                <span class="checkmark1"></span>                
					                </label>
					                </div>
					                <div class="form-check-inline">
					                <label class="container1">Masculin
					                <input type="radio" name="gender" value="Masculin">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					                <div class="form-check-inline">
					                <label class="container1">LGBTQ+
					                <input type="radio" name="gender" value="LGBTQ+">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					            </div>
					                        
					            <div class="mb-3">
					                <label>Date of Birth </label>
					              <input type="date" class="form-control"  name="dob">
					            </div>


					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Actual Citizenship" name="actual">
					            </div>

					            <div class="mb-3">
					                    

					                <h6>Ethnic Group or Tribe</h6>
					                <div class="form-check-inline">
					                <label class="container1">Hispanic or Latino
					                <input type="radio" checked="checked" name="ethnic" value="Hispanic or Latino">
					                <span class="checkmark1"></span>                
					                </label>
					                </div>


					                <div class="form-check-inline">
					                <label class="container1">White
					                <input type="radio" name="ethnic" value="White">
					                <span class="checkmark1"></span>
					                </label>
					                </div>


					                <div class="form-check-inline">
					                <label class="container1">Asian
					                <input type="radio" name="ethnic" value="Asian">
					                <span class="checkmark1"></span>
					                </label> </div>


					                <div class="form-check-inline">
					                <label class="container1">Black or African American
					                <input type="radio" name="ethnic" value="Black or African American">
					                <span class="checkmark1"></span>
					                </label> </div>


					                <div class="form-check-inline">
					                <label class="container1">Indigene
					                <input type="radio" name="ethnic" value="Indigene">
					                <span class="checkmark1"></span>
					                </label>
					                </div>


					                <div class="form-check-inline">
					                <label class="container1">Native American
					                <input type="radio" name="ethnic" value="Native American">
					                <span class="checkmark1"></span>
					                </label>
					                </div>


					                <div class="form-check-inline">
					                <label class="container1">Other
					                <input type="radio" name="ethnic" value="Other">
					                <span class="checkmark1"></span>
					                </label>
					                </div>
					      
					            </div>

					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Religion" name="religion">
					            </div>

					            <div class="mb-3">
					                <label> What is the date you left your country? </label>
					              <input type="date" class="form-control" placeholder="Date you left your country" name="dleft">
					            </div>

					            <div class="mb-3">
					                <label> When did you arrive in the United State? Full date. </label>
					              <input type="date" class="form-control" placeholder="Date you arrived in the United States" name="aleft">
					            </div>

					            <div class="mb-3">                              
					                <h6>Do you have I-94?</h6>
					                <div class="form-check-inline">
					                    <label class="container1">No, I don’t have one.
					                    <input type="radio" checked="checked" name="first" value="No">
					                    <span class="checkmark1"></span>                
					                    </label>
					                </div>
					    
					                <div class="form-check-inline">
					                    <label class="container1">Yes I have one.
					                    <input type="radio" name="first" value="Yes">
					                    <span class="checkmark1"></span>
					                    </label>
					                </div>
					    
					                <div class="form-check-inline">
					                    <label class="container1">I do not know.
					                    <input type="radio" name="first" value="I do not know">
					                    <span class="checkmark1"></span>
					                    </label> 
					                </div>				    
					            </div>

					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="City where you crossed the board" name="crossed">
					            </div>

					            <div class="mb-3">         

					              	<h6>Have you been to the United States previously?</h6>

					                <div class="form-check-inline">
					                    <label class="container1">Yes
					                    <input type="radio" checked="checked" name="previously" value="Yes">
					                    <span class="checkmark1"></span>                
					                    </label>
					                </div>				    
					    
					                <div class="form-check-inline">
						                <label class="container1">No
						                <input type="radio" name="previously" value="No">
						                <span class="checkmark1"></span>
						                </label>
					                </div> 				             
					           </div>
					          

					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Country you were born" name="born">
					            </div>          
					             
					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="Do you have a passport?" name="passport">
					            </div>

					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="Passport number" name="pnumber">
					            </div>

					            <div class="mb-3">
					                <input type="date" class="form-control" placeholder="Expiry date of the password" name="expiry">
					            </div>
					         
					            
					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Your native language" name="native">
					            </div>

					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Other Languages you are fluent in" name="other">
					            </div>

					            <div class="mb-3">
					       
					              <h6>Have you been to the US before?</h6>
					              
						            <div class="form-check-inline">
						              <label class="container1">Yes
						              <input type="radio" checked="checked" name="before1" value="Yes">
						              <span class="checkmark1"></span>                
						              </label>
					             	</div>


					              	<div class="form-check-inline">
						              <label class="container1">No
						              <input type="radio" name="before1" value="No">
						              <span class="checkmark1"></span>
						              </label>
					              	</div>  
					            </div>

					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Do you have a passport?"  name="have">
					            </div>
					            
					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="Passport number" name="phave">
					            </div>
					            <div class="mb-3">
					                <label>Expiry date of the passport? </label>
					                <input type="date" class="form-control" placeholder="Expiry date of the passport" name="ehave">
					            </div>
					           
					            <hr>
					            <h5>Your Spouse Info:</h5>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="First Name" name="sfname">
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Middle Name" name="smname">
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Last Name" name="slname">
					            </div>
					            <div class="mb-3">
					              	<input type="date" class="form-control" placeholder="Date of Birth"name="sdob" >
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Birthplace (City, Province, Country)" name="bplace">
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Social Security Number" name="ssnumber">
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Your Spouse’ Alien Number" name="saname">
					            </div>
					            <div class="mb-3">
					              	<input type="text" class="form-control" placeholder="Previous name if any" name="pname">
					            </div>
					            <div class="mb-3">
					                <label> Wedding Date </label>
					              <input type="date" class="form-control" placeholder="Wedding Date" name="wdate">
					            </div>
					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Wedding location (City, Province or State, Country)" name="wlocation">
					            </div>
					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Country of Citizenship" name="scountry">
					            </div>
					            <div class="mb-3">
					              <input type="text" class="form-control" placeholder="Race, Ethnic Group" name="srace">
					            </div>
					            <div class="mb-3">
					              <input type="text" class="form-control"  placeholder="Is your Spouse in the USA?" name="sin">            
					            </div>
					        
					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="If in usa , Where in the USA?" name="swhere">
					            </div>
					            <div class="mb-3">
					                <label> Date of Entry within the US ?</label>
					                <input type="date" class="form-control" placeholder="Date of Entry within the USA" name="sentry">
					            </div>
					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="Last time your spouse was in the USA" name="slast">
					            </div>
					            <div class="mb-3">
					                <input type="text" class="form-control" placeholder="Your spouse I-94" name="second">
					            </div>
					            <div class="d-grid">
					              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					              <!-- <button class="btn btn-info mt-3"  type="submit"  name="submit">Register</button> -->
					            </div>
				         	</form>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>




@endsection


<!-- Page Content End -->
  
  
       