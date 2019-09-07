<title>Cart | Meldi Store</title>
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
            <h3 class="h3 mb-3 text-black">KERANJANG</h3>
        </div>
        <br>
        <?php if($this->session->flashdata('flashcart')=="1"){ ?>
            <div align="center" class="col-md-12">
                <h3 style="color:green;" class="h3 mb-3">Keranjang anda berhasil di-update</h3>
            </div>
            <br>
        <?php } ?>
        <?php if($this->session->flashdata('flashcart')=="2"){ ?>
            <div align="center" class="col-md-12">
                <h3 style="color:green;" class="h3 mb-3">Berhasil menghapus "<?php echo $this->session->flashdata('namacart'); ?>" dari keranjang</h3>
            </div>
            <br>
        <?php } ?>
        <div class="row mb-5">
		<?php $tampungCart=0; $subtotal=0; foreach ($cart as $keranjang){$tampungCart++;} ?>
		<?php if ($tampungCart != 0 ){ ?>
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
                    <th class="product-remove">Hapus</th>
                  </tr>
                </thead>
                <tbody id="pagin">
                
                <form action = "<?php echo base_url(); ?>cart/updateCartItem" method="post">
                <?php foreach ($cart as $keranjang){?>
                  <tr>
                  <?php if ($keranjang->productType == "Sepatu Pria"){
                      $urlGambar = base_url()."assets/produkPria/";
                      }else{
                      $urlGambar = base_url()."assets/produkWanita/";
                      }
                  ?>
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
                        <div class="input-group-prepend">
                          <button style="width:30px;" class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="hidden" name="cart_id[]" value="<?php echo $keranjang->id_cart; ?>" />
                        <input readonly="readonly" type="text" name="quantity[]" class="form-control text-center" value="<?php echo $keranjang->quantity; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button style="width:30px;" class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                      </div>

                    </td>
                    <td><?php $beratTotal = ($keranjang->productWeight*$keranjang->quantity); $beratKeranjang = $beratKeranjang+$beratTotal; echo $beratTotal;?> kg</td>
					          <td><?php $total = ($keranjang->productPrice*$keranjang->quantity); echo strrev(implode('.',str_split(strrev(strval($total)),3))); $subtotal=$subtotal+$total;?></td>
                    <td><?php $this->session->set_flashdata('nama', $keranjang->productName); ?><a href="<?php echo base_url(); ?>cart/hapus/<?php echo $keranjang->id_cart; ?>" onclick="return confirm('Yakin hapus dari keranjang')" class="btn btn-primary btn-sm">X</a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
         </div>
		<?php }else { echo " 
		<div align='center' class='col-md-12'>
			<h3 style='color:red;' class='h3 mb-3'>Keranjang anda kosong, silahkan berbelanja :)</h3>
		</div>"; }?>
        </div>
		
		<?php if ($tampungCart != 0 ){ ?>
        <div class="row">
          <div class="col-md-5 pl-5">
            <div class="row mb-5">
			  <div style="color:red;margin-bottom:20px;" class="col-md-12">
                Jangan lupa untuk "UPDATE KERANJANG" setelah mengubah kuantitas/jumlah produk di keranjang anda
              </div>
              <div class="col-md-6 mb-3 mb-md-0">
                <a class="btn btn-outline-primary btn-sm btn-block" href="<?php echo base_url(); ?>arrival" >Lihat Produk Terbaru</a>
              </div>
              <div class="col-md-6">
                <input type="submit" class="btn btn-primary btn-sm btn-block" value="Update Keranjang" />
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-7 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-12">
			  
			<form action="<?php echo base_url(); ?>checkout/checkout" method="post" onsubmit="return confirm('Alamat Pengiriman Sudah Yakin Benar?') " >
				<div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Alamat Pengiriman</h3>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Lokasi Pengiriman :</span>
                  </div>
				  
				  <input type="hidden" id="sel1" />
				  <input type="hidden" id="sel2" />
				  
                  <div class="col-md-6 text-right">
                    <strong class="text-black">Meldistore, Jl. Rw. Taman Cimanggis, Tanah Sereal, Kota Bogor, Jawa Barat</strong>
                  </div>
                </div>
				
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Lokasi Tujuan :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <div class="form-group">  
					  <select name="provG" class="form-control" id="sel11" required>
						<option value=""> Pilih Provinsi</option>            
					  </select>
					  <input type="hidden" name="provGG" id="provGG" />
					</div>
                  </div>
				  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
					  <div class="form-group">  
						  <select name="kotaG" class="form-control" id="sel22" disabled required>
							<option value=""> Pilih Kota</option>            
						  </select>
						  <input type="hidden" name="kotaGG" id="kotaGG" />
					  </div>
                  </div>
				  
				  
				  
				  <?php foreach ($pengguna as $guna){
					  $userKecamatan = $guna->userKecamatan;
					  $userDesa = $guna->userDesa;
					  $userDetailAlamat = $guna->userDetailAlamat;
				  }
				  ?>
				  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
					  <div class="form-group">  
						  <select name="detailSaya" class="form-control" id="detail" required disabled >
							<option value=""> Tentukan Detail Alamat</option>    
							<option value="saya"> Gunakan Alamat Saya</option>  
							<option value="baru"> Gunakan Alamat Baru</option>  
						  </select>
					  </div>
					  <div class="text-black" id = "alamatSaya" style="margin-bottom:20px;display:none;">
						<input type="hidden" name="detailG" value="<?php echo $userDetailAlamat.", ".$userDesa.", ".$userKecamatan; ?>" /><?php echo $userDetailAlamat.", ".$userDesa.", ".$userKecamatan; ?> <br> <span id="ubahDetail" style="cursor:pointer;color:blue;"> Kembali </span>
					  </div>
					  <div class="form-group" id="alamatBaru" style="display:none;" >  
						  <input type="text" placeholder="Masukkan Detail Alamat" class="form-control" name="newAddress" id="newAddress" /> <span id="ubahBaru" style="cursor:pointer;color:blue;"> Kembali </span>
					  </div>
                  </div>
				  
				  
				  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
					<div class="form-group">  
					  <select name="kurirG" class="form-control" id="kurir" disabled required>
						<option value=""> Pilih Kurir</option>
						<option value="jne">JNE</option>
						<option value="tiki">TIKI</option>
						<option value="pos">POS Indonesia</option>
					  </select>
					</div>
                  </div>
				  <div class="col-md-6">
                    
                  </div>
                  <div class="col-md-6 text-right">
                    <div name="paketG" class="form-group">
						<select class="form-control" id="hasil" disabled required>
							<option value=""> Pilih Paket</option>            
						</select>
						<input type="hidden" name="paketG" id="paketG" />
					</div>
                  </div>
                </div>
				<br>
				
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Biaya Total</h3>
                  </div>
                </div>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Berat Keranjang :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><input type="hidden" value="<?php echo $beratKeranjang; ?>" id="berat" name="beratG" />  <?php echo $beratKeranjang; ?> kg</strong>
                  </div>
                </div>
				<hr>
				<div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Durasi Pengiriman :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black" id="durasi">Durasi Pengiriman Belum Ditentukan</strong>
					<input type="hidden" id="durasiG" name="durasiG" /> 
                  </div>
                </div>
				<hr>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Ongkos Kirim :</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black" id="ongkir" >Ongkir Belum Ditentukan </strong>
					<input type="hidden" id="ongkirG" name="ongkirG" /> 
                  </div>
                </div>
				<hr>
                <div class="row mb-3">
                  <div class="col-md-7">
                    <span class="text-black">Subtotal (Total Keranjang + PPN 5%) :</span>
                  </div>
                  <div class="col-md-5 text-right">
					<input type="hidden" id="subtotaltotal" value="<?php echo $subtotal ?>" />
                    <strong class="text-black" id="subtotal" name="abc">Subtotal Belum Ditentukan</strong>
					<input type="hidden" id="subtotalZ" name="subtotalZ" /> 
                  </div>
                </div>
				<hr>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total (Subtotal + Ongkir) :</span>
                  </div>
                   <div class="col-md-6 text-right">
                    <strong style="color:red;" class="h5" id="total">Total Belum Ditentukan</strong>
					<input type="hidden" id="totalZ" name="totalZ" /> 
                  </div>
                </div>
				
				 <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Catatan Pengiriman</h3>
                  </div>
				  <div class="col-md-12">
					<div class="form-group">
						<textarea rows="4" class="form-control" name="noteG" placeholder="Silahkan masukkan catatan penting kamu... (boleh di kosongkan karena bersifat optional)" ></textarea>
					</div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Lanjut Checkout</button>
                  </div>
                </div>
				
				
				</form>
              </div>
            </div>
          </div>
        </div>
		<?php } ?>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/pagination/src/jquery.paginate.js"></script>
    <script>
        //call paginate
        $('#pagin').paginate();
    </script>
    <?php $this->load->view('v_footer_foot'); ?>
  </div>

<script type="text/javascript">
  
function getLokasi() {
  var $op = $("#sel1"),$oc = $("#sel2"), $op1 = $("#sel11");
  $op.val(6); 
  $oc.val(79);
  $.getJSON("provinsi", function(data){  
    $.each(data, function(i,field){  
       $op1.append('<option value="'+field.province_id+'">'+field.province+'</option>'); 

    });
    
  });
 
}

getLokasi();

$("#sel11").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val(); 
  var optionText = $("option:selected", this).text();
  $('#sel22 option:gt(0)').remove();
  $('#kurir').val('');
  $("#hasil").val(''); 
  $("#detail").val(''); 

  $('#detail').show();
  $("#newAddress").prop('required',false);
  $('#newAddress').val('');
  $('#alamatSaya').hide();
  $('#alamatBaru').hide();

  if(option==='')
  {  
    $("#sel22").prop("disabled", true);
	$("#detail").prop("disabled", true);
    $("#kurir").prop("disabled", true);
	$("#hasil").prop("disabled", true); 
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
  }
  else
  {        
	$("#provGG").val(optionText);
    $("#sel22").prop("disabled", false);
    getKota1(option);
  }
});






$("#sel22").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val(); 
  var optionText = $("option:selected", this).text();  
  $('#kurir').val('');
  $("#hasil").val(''); 
  $("#detail").val(''); 

  $('#detail').show();
  $("#newAddress").prop('required',false);
  $('#newAddress').val('');
  $('#alamatSaya').hide();
  $('#alamatBaru').hide();
  if(option==='')
  {   
	$("#detail").prop("disabled", true);
    $("#kurir").prop("disabled", true);
	$("#hasil").prop("disabled", true); 
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
  }
  else
  {        
	$("#kotaGG").val(optionText);
    $("#detail").prop("disabled", false);  
  }
});

$("#detail").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val();    
  $('#kurir').val('');
  $("#hasil").val(''); 
  if(option==='')
  {   
    $("#kurir").prop("disabled", true);
	$("#hasil").prop("disabled", true); 
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
  }
  
  if(option === "saya"){
	  $('#alamatSaya').show();
	  $('#detail').hide();
	  $("#kurir").prop("disabled", false);  
  }
  if(option === "baru"){
	  $('#alamatBaru').show();
	  $('#detail').hide();
	  $("#kurir").prop("disabled", false);
	  $("#newAddress").prop('required',true);
  }
});

$("#ubahDetail").on("click", function(e){
  e.preventDefault();
  $('#detail').val('');
  $('#kurir').val('');
  $("#hasil").val('');
  
	$("#kurir").prop("disabled", true);
	$("#hasil").prop("disabled", true); 
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
	
  $('#detail').show();
  $('#alamatSaya').hide();
});

$("#ubahBaru").on("click", function(e){
  e.preventDefault();
  $('#detail').val('');
  $('#kurir').val('');
  $("#hasil").val('');
  
	$("#kurir").prop("disabled", true);
	$("#hasil").prop("disabled", true); 
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
	
	$("#newAddress").prop('required',false);
	$('#detail').show();
	$('#newAddress').val('');
  $('#alamatBaru').hide();
});




$("#kurir").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val();    
  var origin = $("#sel2").val();
  var des = $("#sel22").val();
  var qty = $("#berat").val();
  $('#hasil').val('');

 
  if(option==='')
  { 
	$("#hasil").prop("disabled", true);
	$("#ongkir").html('Ongkir Belum Ditentukan');
	$("#durasi").html('Durasi Pengiriman Belum Ditentukan');	
	$("#subtotal").html('Subtotal Belum Ditentukan');
	$("#total").html('Total Belum Ditentukan');
  }
  else
  {         
	$("#hasil").prop("disabled", false);  
    getOrigin(origin,des,qty,option);
  }
});


function getOrigin(origin,des,qty,cour) {
  var $op = $("#hasil"); 
  var $id = $("#ongkir");
  var $durasi = $("#durasi");
  var i, j, x = "";
  if ($op !== '') {
	  $op.html("<option value=''>Pilih Paket</option");
  }
 
  $.getJSON("tarif/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){     
    $.each(data, function(i,field){  
		
		
      for(i in field.costs)
      {	
			$op.append("<option value='"+field.costs[i].service+"'>("+ field.costs[i].service +") "+field.costs[i].description+"</option>");
      }
	 

    });
  });
 
}

$("#hasil").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val();    
  var origin = $("#sel2").val();
  var des = $("#sel22").val();
  var qty = $("#berat").val();
  var cour = $("#kurir").val();
  var $id = $("#ongkir");
  var $durasi = $("#durasi");
  
  
  var $subtotaltotal = $("#subtotaltotal");
  var $subtotal = $("#subtotal");
  var $subtotalZ = $("#subtotalZ");
  
  
  var $total = $("#total");
  var $totalZ = $("#totalZ");

  if (option ===''){
    $("#ongkir").html('Ongkir Belum Ditentukan');
    $("#durasi").html('Durasi Pengiriman Belum Ditentukan');	
    $("#subtotal").html('Subtotal Belum Ditentukan');
    $("#total").html('Total Belum Ditentukan');
  }else{

 
  
   $.getJSON("tarif/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){     
    $.each(data, function(i,field){

		for(i in field.costs){
			
				if(field.costs[i].service == option){
					 $("#paketG").val("("+field.costs[i].service+") "+field.costs[i].description);
					 for (j in field.costs[i].cost) {
						 
						
						var bilangan = field.costs[i].cost[j].value;
						$("#ongkirG").val(field.costs[i].cost[j].value);
		
						var	reverse = bilangan.toString().split('').reverse().join(''),
							ribuan 	= reverse.match(/\d{1,3}/g);
							ribuan	= ribuan.join('.').split('').reverse().join('');
							
							$id.html("Rp. "+ribuan);
							$durasi.html(field.costs[i].cost[j].etd+" Hari");
							$("#durasiG").val(field.costs[i].cost[j].etd+" Hari");
							
						var bilanganSub = parseFloat($subtotaltotal.val(), 10)+(parseFloat($subtotaltotal.val(), 10)*0.05);
		
						var	reverseSub = bilanganSub.toString().split('').reverse().join(''),
							ribuanSub 	= reverseSub.match(/\d{1,3}/g);
							ribuanSub	= ribuanSub.join('.').split('').reverse().join('');
						

						$subtotal.html("Rp. "+ribuanSub);
						$subtotalZ.val(bilanganSub);
						
						var totalZZZ = bilanganSub + field.costs[i].cost[j].value
						var	reverseTotal = totalZZZ.toString().split('').reverse().join(''),
							ribuanTotal 	= reverseTotal.match(/\d{1,3}/g);
							ribuanTotal	= ribuanTotal.join('.').split('').reverse().join('');
							
							
						$total.html("Rp. "+ribuanTotal);
						$totalZ.val(totalZZZ);
						
					}
				}
		}
	});
  });
  }
});


function getKota1(idpro) {
  var $op = $("#sel22"); 
  
  $.getJSON("kota/"+idpro, function(data){      
    $.each(data, function(i,field){  
    

       $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>'); 

    });
    
  });


}


</script>

    
  </body>