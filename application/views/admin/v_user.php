
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
                                <strong class="card-title">Data User</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>E-mail</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                            <th>Awal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($user as $user) { ?>
                                        <tr>
                                            <td><?php echo $user->userFullName; ?></td>
                                            <td><?php echo $user->userEmail; ?></td>
                                            <td><?php echo $user->userPhoneNumber; ?></td>
                                            <td><?php echo $user->userDetailAlamat.", ".$user->userDesa.", ".$user->userKecamatan.", ".$user->userKabupaten.", ".$user->userProvinsi; ?></td>
                                            <td><?php echo $user->awal_daftar; ?></td>
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