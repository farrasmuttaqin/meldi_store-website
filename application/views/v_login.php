<title>Login | Meldi Store</title>
<style>
input:disabled {
  cursor: not-allowed;
}
#map {
        height: 40%;
      }
    #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      .notelp {
    background-color: white;
    background-repeat: no-repeat;
    background-size: auto 26px;
    background-position: 98% 50%;
  
  
}
</style>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#provinsi").change(function (){
				var url = "<?php echo site_url('login/add_ajax_kab');?>/"+$(this).val();
				$('#kabupaten').load(url);
				return false;
			})
   
			$("#kabupaten").change(function (){
				var url = "<?php echo site_url('login/add_ajax_kec');?>/"+$(this).val();
				$('#kecamatan').load(url);
				return false;
			})
   
			$("#kecamatan").change(function (){
				var url = "<?php echo site_url('login/add_ajax_des');?>/"+$(this).val();
				$('#desa').load(url);
				return false;
			})
		});
	</script>
<body>
  <div class="site-wrap">
  <?php $this->load->view("navbar_content"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row" id="loginR" <?php if($this->session->flashdata('lolwut')=="1"||$this->session->flashdata('lolwut')=="3"||$this->session->flashdata('lolwut')=="4"){ echo "style='display:none;'";} ?>>
          <div align="center" class="col-md-12">
            <h3 class="h3 mb-3 text-black">LOGIN</h3>
          </div>
          <?php if($this->session->flashdata('lolwut')=="2"){
                  echo "
                  <div align='center' class='col-md-12'>
                    <h5 class='h5 mb-3'>
                      <span style='color:green;'>Register Success, Check Your Email and Activate Your Account</span>
                    </h5>
                  </div>";
                } 
              ?>
          <?php
            if ($this->session->flashdata('lolwut')=="99")
            {
              echo "<div align='center' class='col-md-12'>
                      <h5 class='h5 mb-3'>
                        <span style='color:red;'>Login Failed <br><br> Email or Password is Wrong</span>
                      </h5>
                    </div>";
            }
            if ($this->session->flashdata('loglog')=="1")
            {
              echo "<div align='center' class='col-md-12'>
                      <h5 class='h5 mb-3'>
                        <span style='color:red;'>Ingin membeli product? silahkan login terlebih dahulu :)</span>
                      </h5>
                    </div>";
            }
            if ($this->session->flashdata('lolwut')=="98")
            {
              echo "<div align='center' class='col-md-12'>
                      <h5 class='h5 mb-3'>
                        <span style='color:red;'>Login Failed <br> Your email is not registered</span>
                      </h5>
                    </div>";
            }
            if ($tampungLogin == 999)
            {
                foreach ($data_userFalse as $akun){
                    $_SESSION["emailFalse"] = $akun->userEmail;
                    $_SESSION["hashh"] = $akun->hashh;
                }
                
                $verify=$this->uri->segment(3);

                if (!$verify == 1){
                    echo "<div align='center' class='col-md-12'>
                        <h5 class='h5 mb-3'>
                          <span style='color:red;'>Account Not Activated <br>You Must Activate your Account to Sign In<br>Please Check Activation Link at <br><br> ".$_SESSION["emailFalse"]." <br><br></span>
                        </h5>
                      </div>";
                    echo "<div align='center' class='col-md-12'>
                      <h6 class='h6 mb-3'>
                        <span style='color:blue;'><a class='forget m-t-5 t-center' href='".base_url()."login/sentVerification/'>Didn't Receive Activation Code? Click Here to Resend it</a></span>
                      </h6>
                    </div>";
                }else{
                  echo "<div align='center' class='col-md-12'>
                    <h5 class='h5 mb-3'>
                      <span style='color:red;'>Activation Code has been Sent <br> Now you can check Activation Code at <br><br> ".$_SESSION["emailFalse"]." <br><br></span>
                    </h5>
                  </div>";
                  echo "<div align='center' class='col-md-12'>
                    <h6 class='h6 mb-3'>
                      <span style='color:blue;'><a  class='forget m-t-5 t-center' href='".base_url()."login/sentVerification/'>Click Here to Resend the Activation Code Again</a></span>
                    </h6>
                  </div>";
                }
            }
          ?>
          <div class="col-md-12">

            <form action="<?php echo base_url(); ?>login/loginAction" method="post">
              <div class="p-1 p-lg-5">
                <div class="form-group row">
                  <div style="margin:0 auto;float:none;" class="col-md-6">
                    <label for="email" class="text-black">E-mail <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="emailL" name="emailL" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div style="margin:0 auto;float:none;" class="col-md-6">
                    <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                  </div>
                </div>
                <div class="form-group row" align="center">
                  <div style="margin:0 auto;float:none;margin-top:20px;" class="col-md-6">
                    <input type="submit" class="btn btn-sm btn-primary" value="LOGIN">
                  </div>
                </div>
              </div>
            </form>
            <div class="form-group row" align="center">
                <div style="margin:0 auto;float:none;" class="col-md-6">
          <label id="forgot" for="forgot" style="color:red;cursor:pointer;">Forgot Password</label><?php if ($superLogin == ""){ ?> &nbsp OR &nbsp <label id="register" for="register" style="color:green;cursor:pointer;">Don't have an account? Register here</label> <?php } ?>
                </div>
            </div>
          </div>
        </div>
        <div class="row" id="registerR"  <?php if($this->session->flashdata('lolwut')=="1"){ echo "style='display:block;'";}else{ echo "style='display:none;'";} ?>>
              <div align="center" class="col-md-12">
                <h2 class="h3 mb-3 text-black">REGISTER</h2>
              </div>
              <?php if($this->session->flashdata('lolwut')=="1"){
                  echo "
                  <div align='center' class='col-md-12'>
                    <h4 class='h4 mb-3'>
                      <span style='color:red;'>Register Failed, Email/Phone Number Already Exist</span>
                    </h4>
                  </div>";
                } 
              ?>
              <div class="col-md-12">

                <form action="<?php echo base_url(); ?>login/register" method="post">
                  <div class="p-1 p-lg-5">
                    <div class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="fullname" class="text-black">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullname" name="namaLengkap" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="email" class="text-black">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                    </div>



                    <div style="margin-top:30px;" class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="phone" class="text-black">Phone Number<span class="text-danger">*</span> </label>
                        <input type="text" class="notelp form-control" id="phone" name="phone" onkeypress="return isNumberKey(event)" placeholder="(Must be correct to enable register button)" required>
                      </div>
                    </div>

                    <div style="margin-top:30px;" class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="address" class="text-black">Address<span class="text-danger">*</span> (Digunakan untuk alamat pengiriman)</label>
                
                        <select name="prov" class="form-control" id="provinsi" required>
                          <option value=''>- Select Provinsi -</option>
                          <?php 
                            foreach($provinsi as $prov)
                            {
                              echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                            }
                          ?>
                        </select>
                        <select style="margin-top:20px;" name="kab" class="form-control" id="kabupaten" required>
                          <option value=''>Select Kabupaten</option>
                        </select>
                        <select style="margin-top:20px;" name="kec" class="form-control" id="kecamatan" required>
                          <option>Select Kecamatan</option>
                        </select>
                        <select style="margin-top:20px;" name="des" class="form-control" id="desa" required>
                          <option>Select Desa</option>
                        </select>

                          <input style="margin-top:20px;"  type="text" class="form-control" id="detailAlamat" name="detailAlamat" placeholder="Nama Jalan, Nomor Bangunan" required>
                      </div>
                    </div>
                    <div style="margin-top:30px;" class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="password" class="text-black">Password<span class="text-danger">*</span></label>
                        <input id='password1' class='form-control' type='password' pattern='.{6,}' title='password requires 6 characters minimum' name='password1' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label for="password" class="text-black">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                      </div>
                    </div>
                    <div class="form-group row" align="center">
                      <div style="margin:0 auto;float:none;margin-top:20px;" class="col-md-6">
                        <input type="submit" class="tombol btn btn-sm btn-primary" id="register" value="REGISTER" disabled>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="form-group row" align="center">
                    <div style="margin:0 auto;float:none;" class="col-md-6">
                        <label id="loginL" for="register" style="color:red;cursor:pointer;">Already have an account? Login now</label>
                    </div>
                </div>
              </div>
            </div>
			<div class="row" id="forgotR" <?php if($this->session->flashdata('lolwut')=="3"||$this->session->flashdata('lolwut')=="4"){ echo "style='display:block;'";}else{ echo "style='display:none;'";} ?>>
			  <div align="center" class="col-md-12">
				<h3 class="h3 mb-3 text-black">FORGOT PASSWORD</h3>
			  </div>
        <?php 
        if($this->session->flashdata('lolwut')=="3"){
            echo "
            <div align='center' class='col-md-12'>
              <h5 class='h5 mb-3'>
                <span style='color:green;'>Password Reset Link has been Sent to your Email</span>
              </h5>
            </div>";
          } 
        ?>
        <?php
         if($this->session->flashdata('lolwut')=="4"){
            echo "
            <div align='center' class='col-md-12'>
              <h5 class='h5 mb-3'>
                <span style='color:red;'>Your Email Address is not Registered <br><br> Please Register at Shoes-Store </span>
              </h5>
            </div>";
          } 
        ?>
			  <div class="col-md-12">

				<form action="<?php echo base_url(); ?>login/forgotAction" method="post">
            <div class="p-1 p-lg-5">
            <div class="form-group row">
              <div style="margin:0 auto;float:none;" class="col-md-6">
              <label for="email" class="text-black">E-mail <span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="emailF" name="emailF" required>
              </div>
            </div>
            <div class="form-group row" align="center">
              <div style="margin:0 auto;float:none;margin-top:20px;" class="col-md-6">
              <input type="submit" class="btn btn-sm btn-primary" value="Send Reset Link">
              </div>
            </div>
            </div>
          </form>
          <div class="form-group row" align="center">
            <div style="margin:0 auto;float:none;" class="col-md-6">
        <label id="loginLL" for="LoginLL" style="color:red;cursor:pointer;">Login Now</label> <?php if ($superLogin == ""){ ?> &nbsp OR &nbsp <?php } ?><label id="registerRR" for="registerRR" style="color:green;cursor:pointer;"> <?php if ($superLogin == ""){ ?> Don't have an account? Register here <?php } ?></label>
            </div>
          </div>
          </div>
        </div>
        </div>
      </div>
    
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
    <script>
        labelR = document.getElementById('register');
        labelL = document.getElementById('loginL');
        registerR = document.getElementById('registerR');
        loginR = document.getElementById('loginR');
		
		var loginLL = document.getElementById('loginLL');
		var registerRR = document.getElementById('registerRR');
		var forgot = document.getElementById('forgot');
		var forgotR = document.getElementById('forgotR');

        labelR.addEventListener('click',function(){
        registerR.style.display="block";
        loginR.style.display="none";
				forgotR.style.display="none";
        });

			

        labelL.addEventListener('click',function(){
        loginR.style.display="block";
        registerR.style.display="none";
				forgotR.style.display="none";
        });
			
			  loginLL.addEventListener('click',function(){
				loginR.style.display="block";
        registerR.style.display="none";
				forgotR.style.display="none";
			  });
			
			  registerRR.addEventListener('click',function(){
				registerR.style.display="block";
        loginR.style.display="none";
				forgotR.style.display="none";
			  });
			
			  forgot.addEventListener('click',function(){
        loginR.style.display="none";
        registerR.style.display="none";
				forgotR.style.display="block";
				})
    </script>
    <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>