
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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Invoice</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor Invoice</th>
                                            <th>Biaya Total</th>
                                            <th>Status Pembayaran</th>
                                            <th>Ongkos Kirim</th>
                                            <th>Status Pengiriman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($invoice as $inv) { ?>
                                        <tr>
                                            <td><?php echo $inv->nomor_invoice; ?></td>
                                            <td><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($inv->orderBiayaTotal)),3))); ?></td>
                                            <td><?php echo $inv->status_pembayaran; ?></td>
                                            <td><?php echo "Rp. ".strrev(implode('.',str_split(strrev(strval($inv->orderBiayaPengiriman)),3))); ?></td>
                                            <td><?php echo $inv->status_pengiriman_barang; ?></td>
                                            <td style="text-align:center;"><a href="<?php echo base_url(); ?>administrator/edit/<?php echo $inv->nomor_invoice; ?>"><span class="fa fa-edit"></span></a> </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>

        <?php $this->load->view('admin/v_footer_foot'); ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

   


</body>