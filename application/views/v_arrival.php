<title>New Arrival | Meldi Store</title>
<body>
  <div class="site-wrap">
    
    <?php $this->load->view("navbar_content"); ?>
	
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">New Arrivals</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>New Arrival Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
            <?php foreach($arrival as $new ) { ?>
              <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">

                  <?php if ($new->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                    }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                    }
                    ?>

                    <img src="<?php echo $urlGambar.$new->productImage; ?>" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="<?php echo base_url("shop/detail/".$new->id_product); ?>"><?php echo $new->productName; ?></a></h3>
                    <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($new->productPrice)),3))); ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>