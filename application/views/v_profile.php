<title>Profile | Meldi Store</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.css" />
<script>
    $(document).ready(function(){
        $("#provinsi").change(function (){
            var url = "<?php echo site_url('profile/add_ajax_kab');?>/"+$(this).val();
            $('#kabupaten').load(url);
            return false;
        })

        $("#kabupaten").change(function (){
            var url = "<?php echo site_url('profile/add_ajax_kec');?>/"+$(this).val();
            $('#kecamatan').load(url);
            return false;
        })

        $("#kecamatan").change(function (){
            var url = "<?php echo site_url('profile/add_ajax_des');?>/"+$(this).val();
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
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">My Profile</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="font-size:18px;">

            
              <?php foreach($getAll as $all) { ?>
              
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Full Name :</label>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black"><?php echo $all->userFullName; ?></label>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">E-mail :</label>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black"><font style="color:green;"><?php echo $all->userEmail; ?> <span class="icon icon-verified_user"></span></font></label>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Phone Number :</label>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black"> <?php echo $all->userPhoneNumber; ?></label>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Address :</label>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" style="text-align:justify;" class="text-black"><?php echo $all->userDetailAlamat.", ".$all->userDesa.", ".$all->userKecamatan.", ".$all->userKabupaten.", ".$all->userProvinsi.", Indonesia"; ?></label>
                    <?php if ($this->session->flashdata('lol')=="99"){
                         echo "<label style='color:green;' for='c_lname' class='text-black'>Change Address Success</label>";
                    }
                    ?>
                    <input id="change" type="button" class="btn btn-primary btn-lg btn-block" value="Change Address">
                    <form id = "formform" style="display:none;" action="<?php echo base_url(); ?>profile/changeAddress" onsubmit="return confirm('Yakin ubah alamat?');" method="post">
                        <select style="margin-top:20px;" name="prov" class="form-control" id="provinsi" required>
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
                        <br>
                        <input id="cancel" type="button" class="btn btn-primary btn-lg btn-block" value="Cancel">
                        <input id="ubah" type="submit" class="btn btn-primary btn-lg btn-block" value="Change Now">
                    </form>
                            
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Waktu Awal Daftar :</label>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black"><?php echo $all->awal_daftar; ?></label>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Change Password :</label>
                  </div>
                  <div class="col-md-6">
                    <?php 
                        if ($this->session->flashdata('lolwut')=="1"){
                            echo "<label style='color:green;' for='c_lname' class='text-black'>Change Password Success</label>";
                        }
                        if ($this->session->flashdata('lolwut')=="2"){
                            echo "<label style='color:red;' for='c_lname' class='text-black'>Change Password Failed</label>";
                        }
                        if ($this->session->flashdata('lolwut')==""){
                    ?>
                    <label for="c_lname" class="text-black"><input id="changePass" type="button" class="btn btn-primary btn-lg btn-block" value="Change Now"></label>
                    <form id = "formChange" style="display:none;" action="<?php echo base_url(); ?>profile/changePassword" onsubmit="return confirm('Yakin ubah password?');" method="post">
                        <input id='password1' class='form-control' type='password' name='p1' placeholder='Old Password' required>

                        <input style="margin-top:20px;" id='password2' class='form-control' type='password' pattern='.{6,}' title='password requires 6 characters minimum' placeholder='New Password' required>

                        <input style="margin-top:20px;" id='password3' class='form-control' type='password' name='p2' placeholder='Confirm New Password' required>
                        <br>
                        <input id="cancelchange" type="button" class="btn btn-primary btn-lg btn-block" value="Cancel">
                        <input id="ubahpassword" type="submit" class="btn btn-primary btn-lg btn-block" value="Change My Password">
                    </form>
                        <?php } ?>
                  </div>
                </div>
             
              <?php } ?>
          
          </div>
		  
		  <div class="col-md-12" style="margin-top:80px;">
			<?php $a =0; foreach ($invoice as $pembelian){ $a++;
			}
			?>
            
            <div class="row">
			  <div style="text-align:center;" class="col-md-12">
				<h4 class="text-black h4 text-uppercase">Riwayat Pembelian</h4>
			  </div>
			</div>
			<?php if ($a == 0 ){ ?>
			<br>
				<div class="row">
				  <div style="text-align:center;" class="col-md-12">
					<h4 style="color:red;" class="text-black h4 text-uppercase">Kamu belum pernah membeli produk kami</h4>
				  </div>
				</div>
			<?php }else { ?>
			<div class="site-blocks-table" style="margin-top:20px;">
			
              <table class="table" >
                <thead>
                  <tr>
                    <th class="product-thumbnail">Nomor Invoice</th>
                    <th class="product-name">Biaya Total</th>
					<th class="product-name">Status Pembayaran</th>
                    <th class="product-price">Status Pengiriman</th>
                    <th class="product-price">Lihat Invoice</th>
                  </tr>
                </thead>
                <tbody id="pagin">
                
                <?php foreach ($invoice as $pembelian){?>
                  <tr>
                    <td class="product-thumbnail">
                      INV-00<?php echo $pembelian->nomor_invoice; ?>
                    </td>
                    <td class="product-name">
                      <?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($pembelian->orderBiayaTotal)),3))); ?>
                    </td>
					          <td class="product-name">
                      <?php echo $pembelian->status_pembayaran; ?>
                    </td>
                    <td><?php echo $pembelian->status_pengiriman_barang; ?> </td>
                    <td><a href="<?php echo base_url(); ?>profile/invoice/<?php echo $pembelian->nomor_invoice; ?>" class="btn btn-primary btn-sm">Lihat INV-00<?php echo $pembelian->nomor_invoice; ?></a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
			<?php } ?>
            </div>
          
          </div>
          
        </div>
      </div>
    </div>
	<script src="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.js"></script>
    <script>
        //call paginate
        $('#pagin').paginate();
    </script>
    <script>
            var password = document.getElementById("password2")
          , confirm_password = document.getElementById("password3");
        
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
        var change = document.getElementById('change');
        var formform = document.getElementById('formform');
        var cancel = document.getElementById('cancel');

        var changePass = document.getElementById('changePass');
        var formchange = document.getElementById('formChange');
        var cancelchange = document.getElementById('cancelchange');

        change.addEventListener("click",function(){
            formform.style.display="block";
            change.style.display="none";
        })

        cancel.addEventListener("click",function(){
            formform.style.display="none";
            change.style.display="block";
        })

        changePass.addEventListener("click",function(){
            formchange.style.display="block";
            changePass.style.display="none";
        })

        cancelchange.addEventListener("click",function(){
            formchange.style.display="none";
            changePass.style.display="block";
        })

    </script>
    <?php $this->load->view("v_footer_foot"); ?>
  </div>
  </body>