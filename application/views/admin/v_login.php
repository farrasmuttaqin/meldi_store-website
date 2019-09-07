
<body style="background-color:rgb(255,92,92);">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?php echo base_url(); ?>assets/images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-logo">
                    <h1 style="color:white;">ADMIN</h1>
                </div>
                <?php if ($this->session->flashdata("error") == "1"){ ?>
                <div class="login-logo">
                    <h4 style="color:black;">Login failed, Username / password wrong</h4>
                </div>
                <?php } ?>
                <div class="login-form">
                    <form action = "<?php echo base_url(); ?>backend/loginAction" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="pass" type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>