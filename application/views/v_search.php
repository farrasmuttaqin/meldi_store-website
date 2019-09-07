<title>Shop | Meldi Store</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.css" />
<style>
    .paginate { padding: 0; margin: 0; }
    .paginate > li { list-style: none; padding: 10px 20px; border: 1px solid #ddd; margin: 10px 0; }
</style>
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
                <div class="float-md-left mb-4"><h4 class="text-black">Mencari "<?php echo $productNameSearch; ?>" di Semua Sepatu</h4> <?php 
                $awal=$_GET['amount2']; $akhir=$_GET['amount3'];

                if ($awal != "" && $akhir != ""){
                  echo "<h5>Mengurutkan dari rentang harga  Rp. ".strrev(implode('.',str_split(strrev(strval($awal)),3)))." hingga Rp. ".strrev(implode('.',str_split(strrev(strval($akhir)),3)))." </h5>";
                }

                if ($az == 1){
                  echo "<h5>Mengurutkan dari nama A - Z </h5>";
                }

                if ($za == 1){
                  echo "<h5>Mengurutkan dari nama Z - A </h5>";
                }

                if ($lh == 1){
                  echo "<h5>Mengurutkan dari harga Terendah </h5>";
                }

                if ($hl == 1){
                  echo "<h5>Mengurutkan dari harga Tertinggi </h5>";
                }
                
                
                ?></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                  
                  </div>
                </div>
              </div>
            </div>

            <?php $a=0; if ($searchFilter != ""){
                 foreach($searchFilter as $semua){ $a++; }
            } ?>

            <?php $b=0; foreach ($data_search as $data){ $b++; } ?>
            
            <div class="row mb-5" <?php if ($a!=0) echo "id='pagin'"; if ($b!=0) echo "id='pagin'"; ?>>
            
            <?php if ($searchFilter == ""){ ?>
            <?php foreach($data_search as $semua){ ?>
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <?php if ($semua->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                    }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                    }
                    ?>
                    <a href="<?php echo base_url("shop/detail/".$semua->id_product); ?>"><img src="<?php echo $urlGambar.$semua->productImage; ?>" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="<?php echo base_url("shop/detail/".$semua->id_product); ?>"><?php echo $semua->productName; ?></a></h3>
                    <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($semua->productPrice)),3))); ?></p>
                  </div>
                </div>
              </div>
            <?php }
            if ($b == 0){
                echo " <div class='col-sm-6 col-lg-4 mb-4'><h5 class='text-black'> Tidak ada hasil</h5></div>";;
                } 
            }else{ $g=0; foreach($searchFilter as $semua){ $h++; ?>
                  
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border">
                    <figure class="block-4-image">
                    <?php if ($semua->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                    }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                    }
                    ?>
                      <a href="<?php echo base_url("shop/detail/".$semua->id_product); ?>"><img src="<?php echo $urlGambar.$semua->productImage; ?>" alt="Image placeholder" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="<?php echo base_url("shop/detail/".$semua->id_product); ?>"><?php echo $semua->productName; ?></a></h3>
                      <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($semua->productPrice)),3))); ?></p>
                    </div>
                  </div>
                </div>
            <?php  } if($h == 0) echo " <div class='col-sm-6 col-lg-4 mb-4'><h5 class='text-black'> Tidak ada hasil</h5></div>"; } ?>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <br>
                <div id="slider-range" class="border-primary" ></div>
                <form action="<?php echo base_url(); ?>search/price" method="GET">
                    <input type="hidden" name="amount2" id="amount2" class="form-control border-0 pl-0 bg-white" />
                    <input type="hidden" name="amount3" id="amount3" class="form-control border-0 pl-0 bg-white" />
                    <input type="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled />
                    <input type="hidden"  name="searching" value="<?php echo $productNameSearch; ?>" />
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