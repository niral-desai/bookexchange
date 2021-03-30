<?php
	include 'header.php';
?>
     <div class="main">
      <div class="shop_top">
	     <div class="container">
						<form action="registration_event.php" id="register_form" method="POST" onsubmit="return matchPass();">
								<div class="register-top-grid">
										<h3>PERSONAL INFORMATION</h3>
										<div class="top">
											<span>First Name<label>*</label></span>
											<input name="firstname" pattern="^[a-zA-Z]{2,15}$" type="text" required/>
										</div>
										
										<div class="top">
											<span>Last Name<label>*</label></span>
											<input name="lastname" pattern="^[a-zA-Z]{2,15}$" type="text" required>
										</div>
										<br>
										<br>
										<br>
										<br>
										<div class="top">
											<span>Email Address<label>*</label></span>
											<input type="email" style="border: 2px solid #EEE; outline-color: #00BFF0; width: 96%; font-size: 1em; padding: 0.5em; font-family: 'Open Sans', sans-serif;" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" name="email" id="email" type="text" required>
										</div>
										<div class="top">
											<span>Choose Username<label>*</label></span>
											<input name="username" pattern="^[a-zA-Z]\w{2,15}$" placeholder="Minimum 3 character" type="text" required>
										</div>
										<div class="top">
											<span>Gender</span>
											<select name="gender">
												<option>Female</option>
												<option>Male</option>
												<option>Other</option>
											</select>
										</div>
										<div class="top">
											<span>Birth date</span>
											<input type="text" placeholder="MM/DD/YYYY format" pattern= "(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" id="datepicker" name="dob">
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>ADDRESS INFORMATION</h3>
										<div class="top">
											<span>Address line #1<label>*</label></span>
											<input type="text" name="address1" required>
										</div>
										<div class="top">
											<span>Address line #2<label>*</label></span>
											<input type="text" name="address2">
										</div>
										<div class="top">
											<span>zipcode<label>*</label></span>
											<input type="text" pattern="(\d{5}?)" placeholder="Enter 5 digit zipcode" name="zipcode" id="zipcode" required>
										</div>
										<div class="top">
											<span>city<label>*</label></span>
											<input type="text" id="city" required>
										</div>
										<div class="top">
											<span>state<label>*</label></span>
											<input type="text" id="state" required>
										</div>
										<div class="top">
											<span>country<label>*</label></span>
											<input type="text" id="country" required>
										</div>
										<div class="top">
											<span>Contact Number<label>*</label></span>
											<input type="text" placeholder="Minimum 10 digit number" pattern= "\d{10}" name="contact" required>
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>LOGIN INFORMATION</h3>
										<div class="top">
											<span>Password<label>*</label></span>
											<input name="password" id="pass1" type="password" placeholder="Length between 6-20 characters" pattern="^[a-zA-Z@*#+-]\w{5,20}$" required>
										</div>
										<div class="top">
											<span>Confirm Password<label>*</label></span>
											<input type="password" id="pass2" placeholder="Retype Password" onblur="matchPass()" pattern="^[a-zA-Z@*#+-]\w{5,20}$" required>
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="submit">
						</form>
						<script type="text/javascript">
							function matchPass() {
							    var pass1 = document.getElementById("pass1").value;
							    var pass2 = document.getElementById("pass2").value;
							    var ok = true;
							    if (pass1 != pass2) {
							        //alert("Passwords Do not match");
							        document.getElementById("pass1").style.borderColor = "#E34234";
							        document.getElementById("pass2").style.borderColor = "#E34234";
							        ok = false;
							    }
							    else{
							    	document.getElementById("pass1").style.borderColor = "#00BFF0";
							        document.getElementById("pass2").style.borderColor = "#00BFF0";	
							    }
							    
							    return ok;
							}
						</script>
					</div>
		   </div>
	  </div>
<?php
	include 'footer.php';
?>
