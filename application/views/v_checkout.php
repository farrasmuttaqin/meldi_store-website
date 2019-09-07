<title>Checkout | Meldi Store</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.css" />

  <body>
  
  <div class="site-wrap">
  <?php $this->load->view('navbar_content'); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo base_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>
    
    

    <div class="site-section">
      <div class="container">
        <div align="center" class="col-md-12">
            <h3 class="h3 mb-3 text-black">INVOICE</h3>
        </div>
        <br>
        <?php foreach ($getInvoice as $keranjang){ 
      $id_user = $keranjang->id_user;
			$nomor_invoice = $keranjang->nomor_invoice; 
			$orderTanggalInvoice = $keranjang->orderTanggalInvoice; 
			$orderProvinsi = $keranjang->orderProvinsi;
			$orderKota = $keranjang->orderKota;
			$orderDetailAlamat = $keranjang->orderDetailAlamat;
			$orderPaketKurir = $keranjang->orderPaketKurir;
			$orderKurir = $keranjang->orderKurir;
			$orderDurasiPengiriman = $keranjang->orderDurasiPengiriman;
			$orderCatatan = $keranjang->orderCatatan;
			
			$orderBeratKeranjang = $keranjang->orderBeratKeranjang;
			$orderBiayaPengiriman = $keranjang->orderBiayaPengiriman;
			$orderBiayaTotal = $keranjang->orderBiayaTotal;
			
			$status_pengiriman_barang = $keranjang->status_pengiriman_barang;
			$status_pembayaran = $keranjang->status_pembayaran;
    }?>
    
    <?php if ($id_user != $this->session->userdata('id_user')){
      redirect(base_url());
    }
    ?>
        <div class="row mb-3">
          <div class="col-md-6">
            <span class="h6 text-black">Nomor : INV-00<?php echo $nomor_invoice; ?> <?php if ($status_pembayaran == "Bukti Transfer Salah"){ echo "<span style='color:red;'>(".$status_pembayaran.")</span>"; }?></span>
          </div>
          <div class="col-md-6 text-right">
            <strong class="text-black">Waktu Checkout : <?php echo $orderTanggalInvoice; ?></strong>
          </div>
        </div>
        <div class="row mb-5">
		<?php $tampungCart=0; foreach ($getInvoice as $keranjang){ $tampungCart = $keranjang->size; } ?>
		<?php if ($tampungCart == "" ){ redirect(base_url()."profile"); }else{ ?>
          <div class="col-md-12">
            <div class="site-blocks-table">
              <table class="table" >
                <thead>
                  <tr>
                    <th class="product-thumbnail">Gambar Produk</th>
                    <th class="product-name">Nama Produk</th>
					          <th class="product-name">Berat Satuan</th>
                    <th class="product-price">Harga Produk</th>
                    <th class="product-price">Ukuran</th>
                    <th class="product-quantity">Kuantitas</th>
                    <th class="product-total">Berat Total</th>
					          <th class="product-total">Harga Total</th>
                  </tr>
                </thead>
                <tbody id="pagin">
                <?php foreach ($getInvoice as $keranjang){?>

                  <?php if ($keranjang->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                      }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                      }
                  ?>

                  <tr>
                    <td class="product-thumbnail">
                      <img src="<?php echo $urlGambar.$keranjang->productImage; ?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $keranjang->productName; ?></h2>
                    </td>
					          <td class="product-name">
                      <?php echo $keranjang->productWeight; ?> kg
                    </td>
                    <td><?php echo strrev(implode('.',str_split(strrev(strval($keranjang->productPrice)),3)))."/pcs"; ?></td>
                    <td><?php echo $keranjang->size; ?></td>
                    <td>
                      <div class="input-group" style="max-width: 100px;">
                        
                        <input readonly="readonly" type="text" class="form-control text-center" value="<?php echo $keranjang->quantity; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        
                      </div>

                    </td>
                    <td><?php $beratTotal = ($keranjang->productWeight*$keranjang->quantity); $beratKeranjang = $beratKeranjang+$beratTotal; echo $beratTotal;?> kg</td>
					          <td><?php $total = ($keranjang->productPrice*$keranjang->quantity); echo strrev(implode('.',str_split(strrev(strval($total)),3))); $subtotal=$subtotal+$total;?></td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
         </div>
		<?php }?>
        </div>
		
		
		
        <div class="row">
          <div class="col-md-5 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-12">
                <div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Data Pengiriman</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Alamat Tujuan : </span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $orderDetailAlamat.", ".$orderKota.", ".$orderProvinsi; ?></strong>
                  </div>
                </div>
				<hr>
                 <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Kurir : </span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $orderKurir; ?></strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Jenis Pengiriman : </span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $orderPaketKurir; ?></strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Durasi Pengiriman : </span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $orderDurasiPengiriman; ?></strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Catatan Pengiriman : </span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php if ($orderCatatan == "") { echo "Tidak ada"; } else { echo $orderCatatan; } ?> </strong>
                  </div>
                </div>
				<br>
				<?php if ($status_pembayaran == "Belum dibayar" || $status_pembayaran == "Bukti Transfer Salah"){ ?>
				<div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Aturan Transfer</h3>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-12">
                    <span class="text-black">
						<ol>
							<li style="text-align:justify;"> Transfer ke Salah Satu Nomor Rekening yang Tersedia</li><br>
							<li style="text-align:justify;"> Nominal Transfer <span style="color:red;">"WAJIB"</span> Sesuai dengan Jumlah <span style="color:red;">Total (Subtotal+ongkir) </span></li><br>
							<li style="text-align:justify;"> Gambar Bukti Transfer Harus Full Image</li><br>
							<li style="text-align:justify;"> Jika Transfer Melalui Internet Banking / Mobile Banking / SMS Banking, maka dapat mengirim Bukti berupa Hasil Screenshot</li>
						</ol>
					</span>
                  </div>
                </div>
        <?php }
        if ($status_pembayaran == "Bukti Transfer Salah"){ ?>
        <br>
        <div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Bukti Transfer Kamu Salah</h3>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-12" style="text-align:justify;">
                    <span class="text-black">
                      Kenapa Bisa Salah ?, Karena : <br><br>
						<ol>
							<li style="text-align:justify;"> Gambar Bukti Transfer Salah</li><br>
							<li style="text-align:justify;"> Nominal yang Di-Transfer Salah</span></li>
            </ol>
             Bagaimana solusinya?, Silahkan kirim bukti transfer kamu kembali <br> <br>Bagaimana Jika Bukti Transfer Sudah Yakin Benar Namun Tetap Salah?, Silahkan Hubungi Customer Service Kami Melalui Whatsapp.
					</span>
                  </div>
                </div>
        <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-7 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-12">
                <div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Biaya Total</h3>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Berat Keranjang :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $orderBeratKeranjang; ?> kg</strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Ongkos Kirim :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($orderBiayaPengiriman)),3))); ?></strong>
                  </div>
                </div>
				<hr>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal (Total Keranjang + PPN 5%) :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php $subtotal = $subtotal + ($subtotal*0.05); echo "Rp. ".strrev(implode('.',str_split(strrev(strval($subtotal)),3))); ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total (Subtotal + Ongkir) :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong style="color:red;" class="h5"><?php $totalz = $subtotal + ($subtotal*0.05); echo "Rp. ".strrev(implode('.',str_split(strrev(strval($orderBiayaTotal)),3))); ?></strong>
                  </div>
                </div>
				
				<?php if ($status_pembayaran == "Sudah dibayar"){ ?>
					
				<div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Status Pembayaran :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="h5" style="color:green;"> <?php echo $status_pembayaran; ?></strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Status Pengiriman :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="h5" style="color:red;"> <?php echo $status_pengiriman_barang; ?>, mohon ditunggu</strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-12">
                    
                  </div>
                  <div class="col-md-12">
                    <span style="color:red;"> *Kami akan Mengirim Pembelian Anda Setelah Melakukan "KONFIRMASI" pada "BUKTI PEMBAYARAN" yang Telah Anda Berikan </span>
                  </div>
                </div>
				
				
        <?php } ?>

        <?php if ($status_pembayaran == "Sudah dikonfirmasi" && $status_pengiriman_barang == "Sudah diterima"){ ?>
					
          <div class="row">
                    <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                      
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pembayaran :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:green;"> <?php echo $status_pembayaran; ?></strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pengiriman :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:green;"> <?php echo $status_pengiriman_barang; ?></strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-12">
                      
                    </div>
                    <div class="col-md-12">
                      <span style="color:green;">Terima kasih sudah berbelanja di Meldi Store, kami tunggu belanjaan anda selanjutnya :)</span>
                    </div>
                  </div>
          
          
          <?php } ?>

        <?php if ($status_pembayaran == "Sudah dikonfirmasi" && $status_pengiriman_barang == "Sedang dikirim"){ ?>
					
          <div class="row">
                    <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                      
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pembayaran :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:green;"> <?php echo $status_pembayaran; ?></strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pengiriman :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:green;"> <?php echo $status_pengiriman_barang; ?></strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-12">
                      
                    </div>
                    <div class="col-md-12">
                      <span style="color:green;"> *Kami sudah mengirim pembelian anda menggunakan jasa kurir "<?php echo $orderKurir; ?>" dengan paket "<?php echo $orderPaketKurir; ?>" ke alamat anda. Mohon ditunggu ya, Terima Kasih</span>
                    </div>
                  </div>
          
          
          <?php } ?>
        
        <?php if ($status_pembayaran == "Sudah dikonfirmasi" && $status_pengiriman_barang == "Belum dikirim"){ ?>
					
          <div class="row">
                    <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                      
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pembayaran :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:green;"> <?php echo $status_pembayaran; ?></strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Status Pengiriman :</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="h5" style="color:red;"> <?php echo $status_pengiriman_barang; ?>, mohon ditunggu</strong>
                    </div>
                  </div>
          <div class="row mb-3">
                    <div class="col-md-12">
                      
                    </div>
                    <div class="col-md-12">
                      <span style="color:green;"> *Kami sudah mengkonfirmasi Bukti Pembayaran Anda dan akan melakukan pengiriman secepatnya, Terima kasih </span>
                    </div>
                  </div>
          
          
          <?php } ?>
				
				
				<?php if ($status_pembayaran == "Belum dibayar" || $status_pembayaran == "Bukti Transfer Salah"){ ?>
				<div class="row">
                  <div style="text-align:center;" class="col-md-12 border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Rekening Transfer</h3>
                  </div>
                </div>
				
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Rekening Pertama :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><img style="width:65%;"src="<?php echo base_url("assets/images/bca.png"); ?>" /> </strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Nomor Rekening :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"> 6042197978  </strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
                    <strong style="color:green;" class="text-black"> a/n MELDA REZA <span class="icon icon-verified_user"></span> </strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Rekening Kedua :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><img style="width:50%;"src="<?php echo base_url("assets/images/bri.png"); ?>" /> </strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Nomor Rekening :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"> 081101042780532  </strong>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
                    <strong style="color:green;" class="text-black"> a/n DIKI AMRIYANSAH <span class="icon icon-verified_user"></span> </strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Upload Bukti Transfer : </span>
                  </div>
                  <div class="col-md-6 text-right">
					<div class="form-group">
					<?php echo "
					<form enctype='multipart/form-data' action='".base_url()."checkout/order' method='post' id='form1' runat='server' "; ?>onsubmit="return confirm('Bukti Pembayaran Yang di Upload Sudah Yakin Benar ?');" <?php echo">
						<h5 style='font-size:14px;padding-top:10px;color:black;'>Pastikan ukuran Gambar tidak melebihi 3 MB </h5>
						<input id='file' type='file' class='form-control' name='gambar' accept='image/*' required />
							<input type='hidden' name='nomor' value='".$nomor_invoice."' />
							<input type='hidden' name='berat' value='".$orderBeratKeranjang."' />
						   <input type='hidden' name='ongkir' value='".$orderBiayaPengiriman."' />
						   <input type='hidden' name='subtotal' value='".$subtotal."' />
						   <input type='hidden' name='total' value='".$orderBiayaTotal."' />
						   <br><img style='width:100%;' id='blah' src='".base_url()."assets/images/upload.png' alt='your image' />
					 "; ?>
									
									
					</div>
                  </div>
				   <script>

                        var uploadField = document.getElementById("file");
						

                        uploadField.onchange = function() {
                            if(this.files[0].size > 2000000){
                               alert("Pastikan ukuran Gambar tidak melebihi 3 MB");
                               this.value = "";
                            }
                        };
						
						

                        function readURL(input) {

                          if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                              $('#blah').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                          }
                        }

                        $("#file").change(function() {
							  readURL(this);
                          
                        });
                    </script>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block" >Bayar</button>
                  </div>
                </div>
				</form>
				<br>
				<div class="row mb-3">
                  <div class="col-md-12">
                    <h5 class="h5" style="color:red;" >Setelah melakukan pembayaran, kami akan mengirimkan konfirmasi pembelian kamu lewat e-mail</h5>
                  </div>
                </div>
				<?php } ?>
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
    <?php $this->load->view('v_footer_foot'); ?>
  </div>

    
  </body>