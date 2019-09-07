
<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="<?php echo base_url(); ?>search/mencari" method="get" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" name="productName" placeholder="Search" required>
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
           
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/toplogo.png" style="width:150px;height:150px;" /></a>
            
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <?php
                    if ($this->session->userdata('email')==""){
                      echo "<li><a href='".base_url()."login'><span style='color:red;' class='icon icon-person'></span></a></li>";
                      echo "
                      <li>
                        <a style='color:red;' href='#'";?> onclick="return alert('Silahkan Login untuk melihat keranjang');" <?php echo "class='site-cart'>
                          <span class='icon icon-shopping_cart'></span>
                        </a>
                      </li>
                      
                      ";
                    }else{
                      echo "<li><a style='color:red;' href='".base_url()."signout'><span class='icon icon-power-off'></span> </a></li> &nbsp
                      <li><a href='".base_url()."profile'><span style='color:green;' class='icon icon-person'></span></a></li>";
                      echo "
                      <li>
                    <a style='color:green;' ";?> <?php $cartcart=0; foreach ($cart as $keranjang){ $cartcart++; } if($cartcart == 0){ ?> onclick="return alert('Keranjang anda kosong');" <?php }else{ echo " href='".base_url()."cart' "; } ?><?php echo "class='site-cart'>
                          <span class='icon icon-shopping_cart'></span>
                          <span class='count'>".$cartcart."</span>
                        </a>
                      </li>
                      ";
                    }
                  ?>
                  
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="sticky-top site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li <?php if($nav == 1) echo "class='active'"; ?>>
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="has-children <?php if($nav == 2) echo "active"; ?>"><a href="<?php echo base_url(); ?>shop">Shop</a>
				<ul class="dropdown">
					<li><a href="<?php echo base_url(); ?>shop/men">All Men Shoes</a></li>
					<li><a href="<?php echo base_url(); ?>shop/woman">All Woman Shoes</a></li>
				  </ul>
			  </li>
            <li <?php if($nav == 3) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>arrival">New Arrivals</a></li>
            <li <?php if($nav == 4) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>education">Education</a></li>
            <li <?php if($nav == 5) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>contact">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>