
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php
            if (isset($_GET['type'])) {
                echo 'Edit Quiz Schedule';
            } else {
                echo 'Add New Quiz Schedule';
            }
            ?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
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
                                    <h4 class="page-title">Category Wise Question</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="page-content-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">                   
                                            <form action="" id="form_data" class="form-horizontal" role="form" method="get" enctype="multipart/form-data" >  
                                                <h4 class="mt-0 header-title">Textual inputs</h4>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Main Category</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control select2" name="main_cat_id" id="main_cat_id" required="" onchange="mainchange();">
                                                            <option>Main Category</option>
                                                            <?php
                                                            foreach ($main_category as $val) {

                                                                echo "<option value=" . $val->id . ">" . $val->main_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class = "button-items">
                                                        <button type = "submit" id="btn_go" name="btn_go" class = "btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="" id="form_data" class="form-horizontal" role="form" method="get" enctype="multipart/form-data" >  

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sub Category</label>
                                                    <input type="hidden" id="main_cat_id1"  name="main_cat_id" class="form-control">

                                                    <div class="col-sm-5">       
                                                        <select class="form-control select2" name="sub_cat_id" id="sub_list" required="">
                                                            <option>Sub Category</option>
                                                            <?php
                                                            foreach ($sub_category as $val) {

                                                                echo "<option value=" . $val->id . ">" . $val->sub_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class = "button-items">
                                                        <button type = "submit" id="pbtn_go" name="btn_go" class = "btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            <h4 class="mt-0 header-title">Result of Quiz</h4>
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Main Category</th>
                                                        <th>Sub Category</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>Question</th>
                                                        <th>Option A</th>
                                                        <th>Option B</th>
                                                        <th>Option C</th>
                                                        <th>Option D</th>
                                                        <th>Answer</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    if ($this->input->get('sub_cat_id')) {

                                                        $k = 1;
                                                        foreach ($view_question as $val) {
                                                            echo "<tr>";
                                                            echo "<td>" . $k++ . "</td>";
                                                            echo "<td>" . $val->main_cat_name . "</td>";
                                                            echo "<td>" . $val->sub_cat_name . "</td>";
                                                            echo "<td>" . $val->cname . "</td>";
                                                            echo "<td>" . $val->state_name . "</td>";
                                                            echo "<td>" . $val->question . "</td>";
                                                            echo "<td>" . $val->option_a . "</td>";
                                                            echo "<td>" . $val->option_b . "</td>";
                                                            echo "<td>" . $val->option_c . "</td>";
                                                            echo "<td>" . $val->option_d . "</td>";
                                                            echo "<td>" . $val->answer . "</td>";
                                                            echo '</tr>';
                                                        }
                                                    } elseif ($this->input->get('main_cat_id')) {

                                                        $k = 1;
                                                        foreach ($view_question1 as $val) {
                                                            echo "<tr>";
                                                            echo "<td>" . $k++ . "</td>";
                                                            echo "<td>" . $val->main_cat_name . "</td>";
                                                            echo "<td>" . $val->sub_cat_name . "</td>";
                                                            echo "<td>" . $val->cname . "</td>";
                                                            echo "<td>" . $val->state_name . "</td>";
                                                            echo "<td>" . $val->question . "</td>";
                                                            echo "<td>" . $val->option_a . "</td>";
                                                            echo "<td>" . $val->option_b . "</td>";
                                                            echo "<td>" . $val->option_c . "</td>";
                                                            echo "<td>" . $val->option_d . "</td>";
                                                            echo "<td>" . $val->answer . "</td>";
                                                            echo '</tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
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


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

        <!-- Plugins js -->
        <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

        <script src="plugins/select2/js/select2.min.js"></script>
        <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
        <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
        <!-- Required datatable js -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <script src="plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <script src="assets/pages/form-advanced.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script type="text/javascript">
                                                            $("#pbtn_go").on('click', function ()
                                                            {
                                                                var fdate = document.getElementById("main_cat_id").value;
                                                                //                    alert(fdate);
                                                                $('#main_cat_id1').val(fdate);

                                                            });
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


