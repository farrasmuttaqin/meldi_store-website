
  <title>Berhasil | Meldi Store</title>
  <body>
  
  <div class="site-wrap">
    <?php $this->load->view("navbar_content"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Pembayaran Berhasil</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Terima Kasih!</h2>
            <p class="lead mb-5">Pembayaran anda sudah kami terima<br>Tunggu konfirmasi dari kami ya :)</p>
            <p><a href="<?php echo base_url(); ?>shop" class="btn btn-sm btn-primary">Belanja Lagi?</a></p>
          </div>
        </div>
      </div>
    </div>

      <?php $this->load->view("v_footer_foot"); ?>
  </div>

    
  </body>