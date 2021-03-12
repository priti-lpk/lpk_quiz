<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php
            if (isset($edit_schedule)) {
                echo 'Edit Quiz Schedule';
            } else {
                echo 'Add Quiz Schedule';
            }
            ?></title>
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

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include 'topbar.php'; ?>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'sidebar.php'; ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Quiz Schedule</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="page-content-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">                   
                                            <form action="<?php echo base_url("Quiz_schedule/InsertSchedule") ?>" id="form_data" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" >  
                                                <h4 class="mt-0 header-title">Textual inputs</h4>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Title</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "Title" name = "title" id = "title" value="<?php echo (isset($edit_schedule) ? $edit_schedule[0]['title'] : ''); ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-date-input" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="date" name = "schedule_date" id = "schedule_date" id="example-date-input" value="<?php echo (isset($edit_schedule) ? $edit_schedule[0]['schedule_date'] : ''); ?>" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Country</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="country_id" id="countries" required="" onchange="countrychange();">
                                                            <option>Select Country</option>
                                                            <?php
                                                            foreach ($country as $val) {
                                                                echo "<option " . ($val->id == $edit_schedule[0]['country_id'] ? 'selected' : '') . " value='" . $val->id . "'>" . $val->cname . "</option> ";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!--                                                </div>
                                                                                                    <div class="form-group row">-->
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">State</label>
                                                    <div class="col-sm-4" id="state_list">
                                                        <select class="form-control select2" name="state_id" id="states" required="">
                                                            <option>Select State</option>
                                                            <?php
                                                            $city = $datas[0][5];
                                                            $editdata = isset($edit_schedule);
                                                            if ($editdata == 1) {
                                                                foreach ($update_state as $val) {
                                                                    echo "<option " . ($val->id == $edit_schedule[0]['state_id'] ? 'selected' : '') . " value=" . $val->id . ">" . $val->state_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Main Category</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="main_cat_id" id="main_cat_id" required="" onchange="mainchange()">
                                                            <option>Main Category</option>
                                                            <?php
                                                            foreach ($main_category as $val) {
                                                                echo "<option " . ($val->id == $edit_schedule[0]['main_cat_id'] ? 'selected' : '') . " value=" . $val->id . ">" . $val->main_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!--                                                </div>
                                                                                                    <div class="form-group row">-->
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sub Category</label>
                                                    <div class="col-sm-4" id="sub_list">
                                                        <select class="form-control select2" name="sub_cat_id" id="sub_cat_id" required="">
                                                            <option>Select Sub Category</option>
                                                            <?php
                                                            foreach ($sub_category as $val) {
                                                                echo "<option " . ($val->id == $edit_schedule[0]['sub_cat_id'] ? 'selected' : '') . " value=" . $val->id . ">" . $val->sub_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea id="elm1" name="description"><?php echo (isset($edit_schedule) ? $edit_schedule[0]['description'] : ''); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class = "button-items">
                                                    <input type = "hidden" name = "action" id = "action" value = "<?php echo (isset($edit_schedule) ? 'edit' : 'add') ?>"/>
                                                    <input type = "hidden" name = "id" id = "id" value = "<?php echo (isset($edit_schedule) ? $edit_schedule[0]['id'] : '') ?>"/>
                                                    <input type = "submit" value="<?php echo (isset($edit_schedule) ? 'Edit' : 'Save') ?>" id = "btn_save" class = "btn btn-primary waves-effect waves-light">
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


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


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

        <script type="text/javascript">
                                                            $(document).ready(function () {
                                                                if ($("#elm1").length > 0) {
                                                                    tinymce.init({
                                                                        selector: "textarea#elm1",
                                                                        theme: "modern",
                                                                        height: 300,
                                                                        plugins: [
                                                                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                                                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                                                            "save table contextmenu directionality emoticons template paste textcolor"
                                                                        ],
                                                                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                                                        style_formats: [
                                                                            {title: 'Bold text', inline: 'b'},
                                                                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                                                                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                                                                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                                                                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                                                                            {title: 'Table styles'},
                                                                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                                                                        ]
                                                                    });
                                                                }
                                                            });
        </script>
        <script type="text/javascript">
            function countrychange()
            {

                var country1 = document.getElementById("countries").value;
                var dataString = 'countries=' + country1;
                //alert(dataString);
                $.ajax({
                    url: "<?php echo base_url() . 'add_question/getstate' ?>",
                    method: "POST",
                    datatype: "html",
                    data: dataString,
                    cache: false,
                    success: function (data)
                    {

                        $("#state_list").html(data);
                    },
                    error: function (errorThrown) {
                        alert(errorThrown);
                        alert("There is an error with AJAX!");
                    }
                });
            }
            ;
        </script>
        <script type="text/javascript">
            function mainchange() {

                var cat = document.getElementById("main_cat_id").value;
                var dataString = 'main_cat_id=' + cat;
                $.ajax({
                    url: "<?php echo base_url() . 'add_question/get_scat' ?>",
                    method: "POST",
                    datatype: "html",
                    data: dataString,
                    cache: false,
                    success: function (data)
                    {
                        $("#sub_list").html(data);
                    },
                    error: function (errorThrown) {
                        alert(errorThrown);
                        alert("There is an error with AJAX!");
                    }
                });
            }
            ;
        </script>
    </body>

</html>


