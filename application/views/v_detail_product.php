<title>Detail Product | Meldi Store</title>
<body>

  <div class="site-wrap">
    <?php $this->load->view("navbar_content"); ?>
    
    <?php foreach ($product as $produk) {
        $productName = $produk->productName;   
        $productPrice = $produk->productPrice;  
        $productWeight = $produk->productWeight;  
        $productType = $produk->productType;
        $productDescription = $produk->productDescription;
        $productImage = $produk->productImage;
    }?>
     <?php if ($produk->productType == "Sepatu Pria"){
        $urlGambar = base_url()."assets/produkPria/";
      }else{
        $urlGambar = base_url()."assets/produkWanita/";
      }
      ?>
    <?php if($productName == ""){ redirect(base_url());} ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $productName; ?></strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo $urlGambar.$productImage; ?>" alt="image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $productName; ?></h2>
            <hr>
            <p class="text-black" style="text-align:justify;"><?php echo $productDescription; ?></p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <label for="c_fname" class="text-black">Berat :</label>

                </div>
                <div class="col-md-6">
                    <label style="color:red;"><?php echo $productWeight; ?> kg </label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <label for="c_fname" class="text-black">Tipe :</label>
                </div>
                <div class="col-md-6">
                    <label style="color:#7971ea;"><?php echo $productType; ?> </label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">Harga :</label>
                </div>
                <div class="col-md-6">
                  <label style="color:#7971ea;"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($productPrice)),3))); ?></label>
                </div>
            </div>
            <hr>
            <form action="<?php echo base_url("cart/add"); ?>" method="post" onsubmit="return confirm('Tambah ke dalam keranjang?');">
            <div class="row">
                <div class="col-md-6">
                <label for="c_fname" class="text-black">Ukuran :</label>
                </div>
                <div class="col-md-6">
                    <select style="color:#7971ea;" name="ukuran" class="form-control" required>
                        <option value=''>Pilih Ukuran</option>
                        <option value='38'>38</option>
                        <option value='39'>39</option>
                        <option value='40'>40</option>
                        <option value='41'>41</option>
                        <option value='42'>42</option>
                        <option value='43'>43</option>
                        <option value='44'>44</option>
                        <option value='45'>45</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="mb-1 d-flex">
              
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                    <label for="c_fname" class="text-black">Kuantitas :</label>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input readonly="readonly" name="quantity" type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                            <input name="id_product" type="hidden" value="<?php echo $this->uri->segment(3); ?>" />
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                </div>
            

            </div>
            <div class="row">
                <div class="col-md-6">
                
                </div>
                <div class="col-md-6">
                <input type="submit" class="buy-now btn btn-sm btn-primary" value="Add to Cart" />
                </div>
            </div>
            </form>
            

          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Produk Serupa</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
            <?php foreach($men as $pria){ ?>
              <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                  <?php if ($pria->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                    }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                    }
                    ?>
                    <img src="<?php echo $urlGambar.$pria->productImage; ?>" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="<?php echo base_url("shop/detail/".$pria->id_product); ?>"><?php echo $pria->productName; ?></a></h3>
                    <p class="text-primary font-weight-bold"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($pria->productPrice)),3))); ?></p>
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