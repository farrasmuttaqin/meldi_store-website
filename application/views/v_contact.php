<title>Contact | Meldi Store</title>
  <body>
  
  <div class="site-wrap">
    
  <?php $this->load->view("navbar_content"); ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
	  <?php if($this->session->flashdata('contact')=="1") { ?>
        <div class="row">
          <div class="col-md-12" align="center">
            <h2 style="color:green;" class="h3 mb-3">Thanks for your message :)</h2>
          </div>
        </div>
	  <?php }else{ ?>
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Get In Touch</h2>
          </div>
          <div class="col-md-7">

            <form action="<?php echo base_url(); ?>contact/insert" method="post" onsubmit="return confirm('Yakin kirim pesan?');">
              
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_firstname" name="c_firstname" required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lastname" name="c_lastname" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_subject" class="text-black">Subject <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_subject" name="c_subject" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Message <span class="text-danger">*</span></label>
                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send Message">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-5 ml-auto">
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">Our Location</span>
              <p class="mb-0">Meldistore, Jl. Rw. Taman Cimanggis, Tanah Sereal, Kota Bogor, Jawa Barat</p>
              <br>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.9003050025512!2d106.78142481477073!3d-6.534273695273716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c39a4d1286d1%3A0xc2c0297543da81ed!2sJl.+Rw.+Taman%2C+Tanah+Sereal%2C+Kota+Bogor%2C+Jawa+Barat!5e0!3m2!1sid!2sid!4v1550024712533" width="100%" height="530" frameborder="0" style="border:0" allowfullscreen></iframe></div>
          </div>
        </div>
	  <?php } ?>
      </div>
    </div>

    <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>