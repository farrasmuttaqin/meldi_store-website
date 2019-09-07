<title>Shop | Meldi Store</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.css" />

<body>
  
  <div class="site-wrap">
   <?php $this->load->view("navbar_content"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black">Sepatu Wanita</h2> <?php 
                $awal=$_GET['amount2']; $akhir=$_GET['amount3'];

                if ($awal != "" && $akhir != ""){
                  echo "<h5>Mengurutkan dari rentang harga  Rp. ".strrev(implode('.',str_split(strrev(strval($awal)),3)))." hingga Rp. ".strrev(implode('.',str_split(strrev(strval($akhir)),3)))." </h5>";
                }

                if ($waz == 1){
                  echo "<h5>Mengurutkan dari nama A - Z </h5>";
                }

                if ($wza == 1){
                  echo "<h5>Mengurutkan dari nama Z - A </h5>";
                }

                if ($wlh == 1){
                  echo "<h5>Mengurutkan dari harga Terendah </h5>";
                }

                if ($whl == 1){
                  echo "<h5>Mengurutkan dari harga Tertinggi </h5>";
                }
                
                
                ?></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                  
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="<?php echo base_url(); ?>shop/waz">Name, A to Z</a>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>shop/wza">Name, Z to A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>shop/wlowhigh">Price, low to high</a>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>shop/whighlow">Price, high to low</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php  if ($womanFilter != ""){
                $a=0; foreach($womanFilter as $wanita){ $a++; }
            } ?>
            
            <div class="row mb-5" <?php if ($a!=0) echo "id='pagin'"; ?>>

            <?php if ($womanFilter == ""){ ?>
            <?php $tampungmen=0; $tampungwoman=0; foreach($men as $pria){$tampungmen++; } foreach($woman as $wanita){ ?>
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="<?php echo base_url("shop/detail/".$wanita->id_product); ?>"><img src="<?php echo base_url("assets/produkWanita/".$wanita->productImage); ?>" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="<?php echo base_url("shop/detail/".$wanita->id_product); ?>"><?php echo $wanita->productName; ?></a></h3>
                    <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($wanita->productPrice)),3))); ?></p>
                  </div>
                </div>
              </div>
            <?php $tampungwoman++; } }else{ $g=0; $tampungmen=0; $tampungwoman=0; foreach($men as $pria){$tampungmen++; } foreach($woman as $wanita){ $tampungwoman++; } foreach($womanFilter as $wanita){ $g++; ?>
                  
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border">
                    <figure class="block-4-image">
                      <a href="<?php echo base_url("shop/detail/".$wanita->id_product); ?>"><img src="<?php echo base_url("assets/produkWanita/".$wanita->productImage); ?>" alt="Image placeholder" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="<?php echo base_url("shop/detail/".$wanita->id_product); ?>"><?php echo $wanita->productName; ?></a></h3>
                      <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($wanita->productPrice)),3))); ?></p>
                    </div>
                  </div>
                </div>
            <?php  } if($g == 0) echo " <div class='col-sm-6 col-lg-4 mb-4'><h5 class='text-black'> Tidak ada hasil</h5></div>"; } ?>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <li class="mb-1"><a href="<?php echo base_url(); ?>shop/men" class="d-flex"><span>Sepatu Pria</span> <span class="text-black ml-auto">(<?php echo $tampungmen; ?>)</span></a></li>
                <li class="mb-1"><a href="<?php echo base_url(); ?>shop/woman" class="d-flex"><span>Sepatu Wanita</span> <span class="text-black ml-auto">(<?php echo $tampungwoman; ?>)</span></a></li>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <br>
                <div id="slider-range" class="border-primary" ></div>
                <form action="<?php echo base_url(); ?>shop/wprice" method="GET">
                    <input type="hidden" name="amount2" id="amount2" class="form-control border-0 pl-0 bg-white" />
                    <input type="hidden" name="amount3" id="amount3" class="form-control border-0 pl-0 bg-white" />
                    <input type="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled />
                    <br>
                    <input type="submit" class="btn btn-secondary btn-sm dropdown-toggle" value="Terapkan" />
                </form>
            </div>
            </div>
          </div>
        </div>

        
        
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.js"></script>

    <script>
        //call paginate
        $('#pagin').paginate();
    </script>
    <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>
</html>