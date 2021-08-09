<!DOCTYPE html>
<?php
//action url
if ((count($site_setting)) > 0) {
    $url = base_url('Setting/EditSetting');
} else {
    $url = base_url('Setting/InsertSetting');
}
?>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Setting</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="<?php echo base_url() . 'plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css' ?>" rel="stylesheet">
        <link href="<?php echo base_url() . 'plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css' ?>" rel="stylesheet">
        <link href="<?php echo base_url() . 'plugins/select2/css/select2.min.css' ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url() . 'plugins/datatables/dataTables.bootstrap4.min.css' ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'plugins/datatables/buttons.bootstrap4.min.css' ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet' ?>" type="text/css" />
        <link href="<?php echo base_url() . 'plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css' ?>" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/metismenu.min.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/icons.css' ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet" type="text/css">

    </head>

    <body>
        <?php include 'topbar.php'; ?>
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include 'sidebar.php'; ?>
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Setting</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="page-content-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">                   
                                            <form action="<?php echo $url ?>" id="form_data" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" >  
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Title</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "About Title" name = "title" id = "title" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['title'] : '') ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="description" class="form-control" placeholder="About Us"><?php echo ((count($site_setting) > 0) ? $site_setting[0]['description'] : '') ?></textarea>
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Company Name</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "Company Name" name = "company_name" id = "title" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['company_name'] : '') ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Contact</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "Contact" name = "contact" id = "contact" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['contact'] : '') ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Address</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "Address" name = "address" id = "address" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['address'] : '') ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Email</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "email" placeholder = "Email" name = "email" id = "title" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['email'] : '') ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Logo</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "file" placeholder = "logo" name = "image" id = "title" value="<?php echo ((count($site_setting) > 0) ? $site_setting[0]['image'] : '') ?>">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">RTL</label>
                                                    <div class="col-sm-10">
                                                        <input type="checkbox" id="switch" switch="none" name="rtl_ltr" <?= (isset($site_setting) ? ($site_setting[0]['rtl_ltr'] == 'rtl' ? 'checked' : '') : '') ?>/>
                                                        <label for="switch" data-on-label="On"data-off-label="Off"></label>

                                                        
                                                    </div>
                                                </div>
                                                <div class = "button-items">
                                                    <div class = "form-group row">
                                                        <div class = "col-sm-2"></div>
                                                        <div class = "col-sm-10">
                                                            <?php if ((count($site_setting)) > 0) { ?>
                                                                <input type = "hidden" name = "id" id = "id" value = "<?php echo ((count($site_setting) > 0) ? $site_setting[0]['id'] : '') ?>">
                                                                <button type = "submit" class = "btn btn-primary btn-block waves-effect waves-light">Edit</button>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Save</button> 
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>
                        <!-- end page content-->

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <?php include 'footer.php' ?>

            </div>
            <script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/js/bootstrap.bundle.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/js/metisMenu.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/js/jquery.slimscroll.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/js/waves.min.js' ?>"></script>

            <script src="<?php echo base_url() . 'plugins/jquery-sparkline/jquery.sparkline.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js' ?>"></script>

            <!-- Plugins js -->
            <script src="<?php echo base_url() . 'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js' ?>"></script>

            <script src="<?php echo base_url() . 'plugins/select2/js/select2.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/bootstrap-maxlength/bootstrap-maxlength.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/jquery-sparkline/jquery.sparkline.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/jquery.dataTables.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/dataTables.bootstrap4.min.js' ?>"></script>
            <!-- Buttons examples -->
            <script src="<?php echo base_url() . 'plugins/datatables/dataTables.buttons.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/buttons.bootstrap4.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/jszip.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/pdfmake.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/vfs_fonts.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/buttons.html5.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/buttons.print.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/buttons.colVis.min.js' ?>"></script>
            <!-- Responsive examples -->
            <script src="<?php echo base_url() . 'plugins/datatables/dataTables.responsive.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/datatables/responsive.bootstrap4.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/pages/datatables.init.js' ?>"></script>
            <!-- Sweet-Alert  -->
            <script src="<?php echo base_url() . 'plugins/sweet-alert2/sweetalert2.min.js' ?>"></script>
            <script src="<?php echo base_url() . 'assets/pages/sweet-alert.init.js' ?>"></script>
            <!-- Plugins Init js -->
            <script src="<?php echo base_url() . 'assets/pages/form-advanced.js' ?>"></script>
            <!-- App js -->
            <script src="<?php echo base_url() . 'assets/js/app.js' ?>"></script>
            <script src="<?php echo base_url() . 'plugins/tinymce/tinymce.min.js' ?>"></script>
    </body>

</html>


