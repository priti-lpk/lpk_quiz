<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php
            if (isset($edit_question)) {
                echo 'Edit Question';
            } else {
                echo 'Add Question';
            }
            ?>
        </title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/images/favicon.ico' ?>">
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
        <style>
            #image-link:hover {
                -webkit-transform: scale(5,5);
                background: white;
            }
        </style>
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include 'topbar.php'; ?>
            <!-- Top Bar End -->

            <!-- ========== Left sidebar Start ========== -->
            <?php include 'sidebar.php'; ?>
            <!-- Left sidebar End -->

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
                                    <h4 class="page-title">Add Question</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="page-content-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">                   
                                            <form action="<?php echo base_url("Add_question/InsertQuestion") ?>" id="form_data" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" >  
                                                <h4 class="mt-0 header-title">Textual inputs</h4>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Main Category</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="main_cat_id" id="main_cat_id" required="">
                                                            <option>Main Category</option>
                                                            <?php
//                                                            $dba = new DBAdapter();
//                                                            $data = $dba->getRow("main_category", array("id", "main_cat_name"), "status='1'");
                                                            foreach ($main_category as $val) {
                                                                echo "<option " . ($val->id == $edit_question[0]['main_cat_id'] ? 'selected' : '') . " value=" . $val->id . ">" . $val->main_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sub Category</label>
                                                    <div class="col-sm-4" id="sub_list">
                                                        <select class="form-control select2" name="sub_cat_id" id="sub_cat_id" required="">
                                                            <option>Select Sub Category</option>
                                                            <?php
                                                            foreach ($sub_category as $val) {
                                                                echo "<option " . ($val[0]['id'] == $edit_question[0]['sub_cat_id'] ? 'selected' : '') . " value=" . $val[0]['id'] . ">" . $val[0]['sub_cat_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Country</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="country_id" id="countries" required="" onchange="countrychange();">
                                                            <option>Select Country</option>
                                                            <?php
                                                            foreach ($countries as $val) {
                                                                echo "<option " . ($val->id == $edit_question[0]['country_id'] ? 'selected' : '') . " value='" . $val->id . "'>" . $val->cname . "</option> ";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">State</label>
                                                    <div class="col-sm-4" id="state_list">
                                                        <select class="form-control select2" name="state_id" id="states" required="">
                                                            <option>Select State</option>
                                                            <?php
                                                            $editdata = isset($edit_question);
                                                            if ($editdata) {
                                                                foreach ($ustate as $val) {
                                                                    echo "<option " . ($val->id == $edit_question[0]['state_id'] ? 'selected' : '') . " value=" . $val->id . ">" . $val->state_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Select Tag</label>
                                                    <div class = "col-sm-4">
                                                        <select name="tag_id[]" id="tag_list" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                            <?php
                                                            $tagids = explode(",", $edit_question[0]['tag_id']);
                                                            foreach ($tag as $val) {
                                                                if (isset($edit_question)) {
                                                                    if (in_array($val->id, $tagids)) {
                                                                        echo "<option value=" . $val->id . " selected>" . $val->tag_name . "</option>";
                                                                    } else {
                                                                        echo "<option value=" . $val->id . ">" . $val->tag_name . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=" . $val->id . ">" . $val->tag_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!--                                                </div>
                                                                                                    <div class = "form-group row">-->
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Image</label>
                                                    <div class = "col-sm-4">
                                                        <input type = "file" id = "image" name = "image" class = "form-control filestyle" data-input = "false" data-buttonname = "btn-secondary">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Question</label>
                                                    <div class = "col-sm-10">
                                                        <input class = "form-control" type = "text" placeholder = "Question" name = "question" id = "question" value="<?php echo (isset($edit_question) ? $edit_question[0]['question'] : ''); ?>" required = "">
                                                        <div class="col-sm-9">
                                                            <div id="user-msg" class="text-danger"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div id="wait" style="display:none;border:0px solid black;position:absolute;top: 40%;left:85%;padding:2px;"><img src='Images/ajax-loader.gif' width="16" height="16" /></div>-->

                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Option A</label>
                                                    <div class = "col-sm-4">
                                                        <input class = "form-control" type = "text" placeholder = "Option A" name = "option_a" id = "option_a" value="<?php echo (isset($edit_question) ? $edit_question[0]['option_a'] : ''); ?>" required = "">
                                                    </div>
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Option B</label>
                                                    <div class = "col-sm-4">
                                                        <input class = "form-control" type = "text" placeholder = "Option B" name = "option_b" id = "option_b" value="<?php echo (isset($edit_question) ? $edit_question[0]['option_b'] : ''); ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Option C</label>
                                                    <div class = "col-sm-4">
                                                        <input class = "form-control" type = "text" placeholder = "Option C" name = "option_c" id = "option_c" value="<?php echo (isset($edit_question) ? $edit_question[0]['option_c'] : ''); ?>" required = "">
                                                    </div>
                                                    <label for = "example-text-input" class = "col-sm-2 col-form-label">Option D</label>
                                                    <div class = "col-sm-4">
                                                        <input class = "form-control" type = "text" placeholder = "Option D" name = "option_d" id = "option_d" value="<?php echo (isset($edit_question) ? $edit_question[0]['option_d'] : ''); ?>" required = "">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Answer</label>
                                                    <div class="col-sm-4" id="state_list">
                                                        <select class="form-control select2" name="answer" id="answer" required="">
                                                            <option<?php
                                                            if (isset($edit_question)) {
                                                                echo $edit_question[0]['answer'] == 'Option A' ? ' selected="selected"' : '';
                                                            }
                                                            ?> value = 'Option A'>Option A</option>
                                                            <option<?php
                                                            if (isset($edit_question)) {
                                                                echo $edit_question[0]['answer'] == 'Option B' ? ' selected="selected"' : '';
                                                            }
                                                            ?> value = 'Option B'>Option B</option>
                                                            <option<?php
                                                            if (isset($edit_question)) {
                                                                echo $edit_question[0]['answer'] == 'Option C' ? ' selected="selected"' : '';
                                                            }
                                                            ?> value = 'Option C'>Option C</option>
                                                            <option<?php
                                                            if (isset($edit_question)) {
                                                                echo $edit_question[0]['answer'] == 'Option D' ? ' selected="selected"' : '';
                                                            }
                                                            ?> value = 'Option D'>Option D</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <input type="hidden" name="user" value="<?php echo $this->session->userdata('user_id'); ?>">

                                                <div class = "button-items">
                                                    <!--<div class="col-sm-4">-->
                                                    <input type = "hidden" name = "action" id = "action" value = "<?php echo (isset($edit_question) ? 'edit' : 'add') ?>"/>
                                                    <input type = "hidden" name = "id" id = "id" value = "<?php echo (isset($edit_question) ? $edit_question [0]['id'] : '') ?>"/>
                                                    <button type = "submit" id = "btn_save" class = "btn btn-primary waves-effect waves-light"><?php echo (isset($edit_question) ? 'Edit' : 'Save') ?></button>
                                                    <!--</div>-->
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

                                            <h4 class="mt-0 header-title">Question List</h4><br>
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Main Category Name</th>
                                                        <th>Sub Category Name</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>Image</th>
                                                        <th>Question</th>
                                                        <th>Option A</th>
                                                        <th>Option B</th>
                                                        <th>Option C</th>
                                                        <th>Option D</th>
                                                        <th>Answer</th>
                                                        <th>Edit / Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $k = 1;
                                                    foreach ($all_data as $val) {
                                                        echo "<tr>";
                                                        echo "<td>" . $k . "</td>";
                                                        echo "<td>" . $val->main_cat_name . "</td>";
                                                        echo "<td>" . $val->sub_cat_name . "</td>";
                                                        echo "<td>" . $val->cname . "</td>";
                                                        echo "<td>" . $val->state_name . "</td>";
                                                        echo "<td><img src='" . base_url('Images/question/' . $val->image . '') . "' alt='image' class='img-responsive' height=50 width=50></td>";
                                                        echo "<td>" . $val->question . "</td>";
                                                        echo "<td>" . $val->option_a . "</td>";
                                                        echo "<td>" . $val->option_b . "</td>";
                                                        echo "<td>" . $val->option_c . "</td>";
                                                        echo "<td>" . $val->option_d . "</td>";
                                                        echo "<td>" . $val->answer . "</td>";
                                                        echo "<td><a href='" . base_url('add_question/update_data/' . $val->id . '') . "' class='btn btn-primary waves-effect waves-light'>Edit</a> <button class='btn btn-danger btn_delete' id='" . $val->id . "' onclick='SetForDelete(this.id);'>Delete</button></td>";

                                                        echo "</tr>";
                                                        $k++;
                                                    }
//           
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div id="myModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="img01">
                                                <div id="caption"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!--end col--> 
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
        <script type="text/javascript">
                                                            $('#question').focusout(function () {
                                                                var qus = document.getElementById("question").value;
                                                                var main = "<?= isset($edit_question) ? $this->uri->segment(3) : '' ?>";
                                                                var my_object = {"add_question": qus, "main_cat": main};
                                                                $.ajax({
                                                                    url: "<?php echo base_url() . 'Index/check_question' ?>",
                                                                    method: "POST",
                                                                    dataType: "html",
                                                                    data: my_object,
                                                                    cache: false,
                                                                    success: function (data) {
//                                                                        alert(data);
                                                                        var useri = data;

                                                                        if (useri == 1) {
                                                                            $("#user-msg").text("This Question already exist!");
                                                                            $("#btn_save").prop('disabled', true);
                                                                        } else {
                                                                            $("#user-msg").text("");
                                                                            $("#btn_save").prop('disabled', false);
                                                                        }
                                                                    },
                                                                    error: function (errorThrown) {
                                                                        alert(errorThrown);
                                                                        alert("There is an error with AJAX!");
                                                                    }
                                                                });
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
        <script type="text/javascript">

            function SetForDelete(id) {

                location.href = "<?php echo base_url() . 'add_question/delete_data/' ?>" + id;

                swal({
                    title: "Are you sure?",
                    text: "This will remove all data related to this?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!"
//                    closeOnConfirm: false,
//                    closeOnCancel: false
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                location.href = "<?php echo base_url() . 'add_question/delete_data/' ?>" + id;
                                swal("Deleted!", "Image has been deleted.", "success");
                            } else {
                                swal("Cancelled", "You have cancelled this :)", "error");
                            }
                        });
            }
        </script>
        <script>

        </script>
    </body>

</html>


