
<body>
    <!-- Left Panel -->

    <?php $this->load->view('admin/v_navbar'); ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

    <?php $this->load->view('admin/v_top_navbar'); ?>

        
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                <?php foreach ($getInvoice as $keranjang){ 
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
            $orderBuktiTransaksi = $keranjang->orderBuktiTransaksi;
            
			$status_pengiriman_barang = $keranjang->status_pengiriman_barang;
            $status_pembayaran = $keranjang->status_pembayaran;
            
            $nama_user = $keranjang->userFullName;
            $email = $keranjang->userEmail;
            $tampungEmail = $email;
        }?>
        
                    <div class="col-md-12">
                    <div class="card">
                            <div class="card-body">
                                                            <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-12">
                                                <span>NOMOR INVOICE : INV-00<?php echo $nomor_invoice; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="invoice-address">
                                                <h3>invoiced to :</h3>
                                                <br>
                                                <h5><?php echo $nama_user; ?></h5><br>
                                                <?php echo $orderDetailAlamat.", ".$orderKota.", ".$orderProvinsi; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <div class="invoice-date">
                                                Tanggal Cetak Invoice : <?php echo $orderTanggalInvoice; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-table table-responsive mt-5">
                                        <table class="table table-bordered table-hover text-right">
                                            <thead>
                                                <tr class="text-capitalize">
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
                                            <tbody style="text-align:center;">
                                            <?php foreach ($getInvoice as $keranjang){?>
                                                <tr>
                                                    <td class="product-thumbnail">
                                                    <?php if ($keranjang->productType == "Sepatu Pria"){
                                                        $urlGambar = base_url()."assets/produkPria/";
                                                        }else{
                                                        $urlGambar = base_url()."assets/produkWanita/";
                                                        }
                                                    ?>
                                                    <img style="width:300px;" src="<?php echo $urlGambar.$keranjang->productImage; ?>" alt="Image" class="img-fluid">
                                                    </td>
                                                    <td class="product-name">
                                                    <h2 class="h5 text-black"><?php echo $keranjang->productName; ?></h2>
                                                    </td>
                                                            <td class="product-name">
                                                    <?php echo $keranjang->productWeight; ?> kg
                                                    </td>
                                                    <td><?php echo strrev(implode('.',str_split(strrev(strval($keranjang->productPrice)),3))); ?></td>
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
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align:center;"><h3>Data Pengiriman</h3></td>
                                                    <td colspan="5"  style="text-align:center;"><h3>Biaya Total</h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="text-align:center;">Alamat Tujuan :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php echo $orderDetailAlamat.", ".$orderKota.", ".$orderProvinsi; ?></td>
                                                    <td colspan="3" style="text-align:center;">Berat Keranjang</td>
                                                    <td colspan="2"  style="text-align:center;"><?php echo $orderBeratKeranjang; ?> kg</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="text-align:center;">Kurir :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php echo $orderKurir; ?></td>
                                                    <td colspan="3" style="text-align:center;">Ongkos Kirim :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($orderBiayaPengiriman)),3))); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="text-align:center;">Jenis Pengiriman :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php echo $orderPaketKurir; ?></td>
                                                    <td colspan="3" style="text-align:center;">Subtotal (Total Keranjang + PPN 5%) :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php  $subtotal = $subtotal + ($subtotal*0.05); echo "Rp. ".strrev(implode('.',str_split(strrev(strval($subtotal)),3))); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="text-align:center;">Catatan Pengiriman :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php if ($orderCatatan == "") { echo "Tidak ada"; } else { echo $orderCatatan; } ?></td>
                                                    <td colspan="3" style="text-align:center;">Total (Subtotal + Ongkir) :</td>
                                                    <td colspan="2"  style="text-align:center;"><?php  echo "Rp. ".strrev(implode('.',str_split(strrev(strval($orderBiayaTotal)),3))); ?></td>
                                                </tr>
                                                <?php if ($status_pembayaran != "Belum dibayar"){ ?>
                                                <tr>
                                                    <td align="center" colspan="4">Bukti Transaksi :</td>
                                                    <td align="center" colspan="4"><img style="width:100%;" src="<?php echo base_url(); ?>assets/bukti/<?php echo $orderBuktiTransaksi; ?>"></td>
                                                </tr>
                                                <?php } ?>
                                            </tfoot>
                                        </table>
                                       
                                    </div>
                               <br> <div class="row align-items-center">
                                        <div class="col-md-6 text-md-center">
                                            <div class="invoice-address">
                                                <h5>Status Pembayaran</h5><br>
                                                <?php  echo $status_pembayaran; ?>                                           
											</div>
                                        </div>
                                        <div class="col-md-6 text-md-center">
                                            <div class="invoice-address">
                                                <h5>Status Penerimaan Barang</h5><br>
                                                <?php  echo $status_pengiriman_barang; ?>                                               
											</div>
                                        </div>
                                    </div>
									<br>
									<?php
                                    if ($status_pengiriman_barang == "Sudah diterima"){

                                    }else{
										if ($status_pengiriman_barang == "Sedang dikirim"){ ?>
										<div class="form-group" style="margin-top:25px;">
                                        <form action='<?php echo base_url()."administrator/konfirmasiPenerimaanBarang2/"; ?>' method='post' enctype='multipart/form-data'>
                                            <label class="col-form-label">Konfirmasi Penerimaan Barang</label>
                                            <select style="height:50px;" class="form-control" name="confirmation" required>
                                                <option value="">Apakah Barang Sudah Diterima ?</option>
                                                <option value="ya">Ya</option>
                                                <option value="tidak">Belum</option>
                                            </select>
                                            <input type="hidden" name="nomor_invoice" value="<?php echo $nomor_invoice; ?>" required />
											<input type="hidden" name="email_user" value="<?php echo $tampungEmail ?>" required />
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Konfirmasi Penerimaan Barang</button>
                                        </form>
                                    </div>
										
										<?php }
                                        if ($status_pembayaran == "Sudah dikonfirmasi" && $status_pengiriman_barang != "Sedang dikirim"){
                                    ?>
                                     <div class="form-group" style="margin-top:25px;">
                                        <form action='<?php echo base_url()."administrator/konfirmasiPenerimaanBarang"; ?>' method='post' enctype='multipart/form-data'>
                                            <label class="col-form-label">Konfirmasi Pengiriman Barang</label>
                                            <select style="height:50px;" class="form-control" name="confirmation" required>
                                                <option value="">Apakah Barang Sudah Dikirim ?</option>
                                                <option value="ya">Ya</option>
                                                <option value="tidak">Belum</option>
                                            </select>
                                            <input type="hidden" name="nomor_invoice" value="<?php echo $nomor_invoice; ?>" required />
											<input type="hidden" name="email_user" value="<?php echo $tampungEmail ?>" required />
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Konfirmasi Pengiriman Barang</button>
                                        </form>
                                    </div>
                                    <?php
                                        }
										if($orderBuktiTransaksi != null){
											if ($status_pembayaran != "Sudah dikonfirmasi"){
                                    ?>
                                    <div class="form-group" style="margin-top:25px;">
                                        <form action='<?php echo base_url()."administrator/konfirmasiPembayaran"; ?>' method='post' enctype='multipart/form-data'>
                                            <label class="col-form-label">Konfirmasi Pembayaran</label>
                                            <select style="height:50px;" class="form-control" id="confirmation" name="confirmation" required>
                                                <option value="">Apakah Bukti Transaksi Bernilai Benar ?</option>
                                                <option value="ya">Ya</option>
                                                <option value="tidak">Tidak</option>
                                            </select>
											<label id="pengiriman1" style="display:none;" class="col-form-label"><br> Konfirmasi Pengiriman</label>
                                            <select id="pengiriman2" style="display:none;height:50px;" class="form-control" name="pengiriman2">
                                                <option value="">Kirim Barang Sekarang ?</option>
                                                <option value="ya">Ya</option>
                                                <option value="tidak">Tidak</option>
                                            </select>
                                            <input type="hidden" name="nomor_invoice" value="<?php echo $nomor_invoice; ?>" required />
											<input type="hidden" name="email_user" value="<?php echo $tampungEmail ?>" required />
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Konfirmasi Pembayaran</button>
                                        </form>
                                    </div>
											<?php }}else{ ?>
									<div align="center" style="margin-top:50px;">
										<h4 style="color:red;"><?php echo "INV-00".$nomor_invoice; ?> Belum Dibayar</h4>
									</div>
									<?php }
                                    } ?>
                                 </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>
        <script>
            var confirmation = document.getElementById('confirmation')
            var pengiriman1 = document.getElementById('pengiriman1');
            var pengiriman2 = document.getElementById('pengiriman2');
            console.log(confirmation);
            
            confirmation.addEventListener('change',function(){
                if (confirmation.value === "ya"){
                    pengiriman1.style.display="inline";
                    pengiriman2.style.display="inline";
                    pengiriman2.setAttribute('required','required');
                }else{
                    pengiriman1.style.display="none";
                    pengiriman2.style.display="none";
                    pengiriman2.required=false;
                }
            })
            
        </script>
        <?php $this->load->view('admin/v_footer_foot'); ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

   


</body>