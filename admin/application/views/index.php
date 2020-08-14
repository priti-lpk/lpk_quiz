
<!DOCTYPE html>
<html lang="en">

    <head>
        <base href="<?php echo base_url(); ?>">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>LPK Quiz</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/images/favicon.ico' ?>">

        <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/metismenu.min.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/icons.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="index.php" class="logo logo-admin"><img src="logo/logo-1.png" height="80" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to LPK Quiz</p>

                        <form class="form-horizontal m-t-30" action="<?php echo base_url('Index/verifyUser') ?>" method="post">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="user_username" placeholder="Enter username">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="password" name="user_pass" placeholder="Enter password">
                            </div>

                            <div class="form-group ">                               
                                <div class="">
                                    <button class="btn btn-primary btn-block w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <?php if ($this->session->flashdata('msg')): ?>
                                <div class='alert alert-danger'>
                                    <center><?php echo $this->session->flashdata('msg'); ?></center>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">                
                <p class="text-muted">Developed with <i class="mdi mdi-heart text-danger"></i> by LPK Technosoft </p>
            </div>

        </div>

        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap.bundle.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/metisMenu.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.slimscroll.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/waves.min.js' ?>"></script>

<!--        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

         App js 
        <script src="assets/js/app.js"></script>-->

    </body>

</html>