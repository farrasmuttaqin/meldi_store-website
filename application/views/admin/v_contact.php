
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
                                <strong class="card-title">Data Contact</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Subjek</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($contact as $user) { ?>
                                        <tr>
                                            <td><?php echo $user->firstName; ?></td>
                                            <td><?php echo $user->lastName; ?></td>
                                            <td><?php echo $user->subject; ?></td>
                                            <td><?php echo $user->message; ?></td>
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