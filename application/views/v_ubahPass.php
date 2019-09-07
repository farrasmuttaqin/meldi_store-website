

<title>Change Password | Meldi Store</title>
<body>
  <div class="site-wrap">
  <?php $this->load->view("navbar_content"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Verification</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
		
        <?php if ($tampung == ""){
            echo "
            <div align='center' class='col-md-12'>
                <h4 class='h4 mb-3 text-black'>
                    <span>Reset Password</span>
                </h4>
            </div>
            ";
        }
        ?>
        
		<?php
			if($tampung != ""){
				echo "<div align='center' class='col-md-12'>
						  <h3 class='h3 mb-3'>
							<span style='color:green;'>Change Password Success, <a href='".base_url()."login/'>Click Here to Login</a></span>
						  </h3>
						</div>";
				
			}else{
				$hashh = $this->uri->segment(3);
				$email = $this->uri->segment(4);  
				echo "
			   <div class='col-md-12'>

				<form action='".base_url()."login/changePassword' method='post'>
					<input type='hidden' name='hashh' value=".$hashh." />
					<input type='hidden' name='email' value=".$email." />
					<div class='p-1 p-lg-5'>
					<div class='form-group row'>
					  <div style='margin:0 auto;float:none;' class='col-md-6'>
					  <label for='email' class='text-black'>Password<span class='text-danger'>*</span></label>
					  <input id='password1' class='form-control' type='password' pattern='.{6,}' title='password requires 6 characters minimum' name='p1' placeholder='Your New Password' required>
					  </div>
					</div>
					<div class='form-group row'>
					  <div style='margin:0 auto;float:none;' class='col-md-6'>
					  <label for='email' class='text-black'>Confirm Password<span class='text-danger'>*</span></label>
					  <input class='form-control' type='password' id='password2' name='p2' placeholder='Repeat Your New Password' required>
					  </div>
					</div>
					<div class='form-group row' align='center'>
					  <div style='margin:0 auto;float:none;margin-top:20px;' class='col-md-6'>
					  <input type='submit' class='btn btn-sm btn-primary' value='Change Password'>
					  </div>
					</div>
					</div>
				</form>
			  </div>";
			}
            ?>
        </div>
	  </div>
	</div>
  <?php $this->load->view("v_footer_foot"); ?>
	<script>
            var password = document.getElementById("password1")
          , confirm_password = document.getElementById("password2");
        
        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
        }
        
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
  </div>
  </body>