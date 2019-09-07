

<title>Verification | Meldi Store</title>
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
            <?php
                if ($tampung==1){
                    echo "<div align='center' class='col-md-12'>
                      <h3 class='h3 mb-3'>
                        <span style='color:green;'>
                        Your account has been successfully activated</span>
                      </h3>
                    </div>";
                }
                if ($tampung==2){
                    echo "<div align='center' class='col-md-12'>
                      <h3 class='h3 mb-3'>
                        <span style='color:green;'>Your account is active</span>
                      </h3>
                    </div>";
                }
            ?>
        </div>
	  </div>
	</div>
  <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>