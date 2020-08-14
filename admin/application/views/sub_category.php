
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php
            if (isset($subcategory_edit_data)) {
                echo 'Edit Sub Category';
            } else {
                echo 'Add Sub Category';
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
        <style>
            #image-link:hover {
                -webkit-transform: scale(4,4);
            }

        </style>

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
                                    <h4 class="page-title">Sub Category</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="page-content-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">                   
                                            <form action="<?php echo base_url("Add_sub_category/InsertSubCategory") ?>" id="form_data" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" >  
                                                <h4 class="mt-0 header-title">Textual inputs</h4>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Main Category</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control select2" name="main_cat_id" id="main_cat_id" required="">
                                                            <option>Main Category</option>
                                                            <?php
                                                            foreach ($main_category as $val) {
//                                                            echo "<option  value='" . $subData[0] . "'>" . $subData[1] . "</option> ";
                                                                echo "<option  value=" . $val->id . " " . ($val->id == $subcategory_edit_data[0]['main_cat_id'] ? 'selected' : '') . ">" . $val->main_cat_name . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sub Catgeory</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="text"  placeholder="Sub Category Name" id="sub_cat_name" name="sub_cat_name" value="<?= (isset($subcategory_edit_data)) ? $subcategory_edit_data[0]['sub_cat_name'] : '' ?>" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" id="sub_image" name="sub_image" class="form-control filestyle" data-input="false" data-buttonname="btn-secondary">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>

                                                    <input type="checkbox" id="switch" switch="none" name="status" <?= (isset($subcategory_edit_data) ? ($subcategory_edit_data[0]['status'] == '0' ? '' : 'checked') : 'checked') ?>/>
                                                    <label for="switch" data-on-label="On"data-off-label="Off"></label>

                                                </div>
                                                <div class="button-items">
                                                    <input type="hidden" name="action" id="action" value="<?php echo (isset($subcategory_edit_data) ? 'edit' : 'add') ?>"/>
                                                    <?= (isset($subcategory_edit_data)) ? '<input type="hidden" name="id" value="' . $this->uri->segment(3) . '">' : '' ?>
                                                    <button type="submit" id="btn_save" class="btn btn-primary waves-effect waves-light"><?php echo (isset($subcategory_edit_data) ? 'Edit' : 'Save') ?></button>
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

                                            <h4 class="mt-0 header-title">Sub Category List</h4><br>
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Main Category</th>
                                                        <th>Sub Category</th>
                                                        <th>Status</th>
                                                        <th>Image</th>
                                                        <th>Edit / Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $k = 1;
                                                    foreach ($sub_category as $val) {
                                                        echo "<tr>";
                                                        echo "<td>" . $k . "</td>";
                                                        echo "<td>" . $val->main_cat_name . "</td>";
                                                        echo "<td>" . $val->sub_cat_name . "</td>";
//                                                        echo "<td>" . $subData[4] . "</td>";
                                                        echo "<td>";
                                                        if ($val->status == '1') {
                                                            echo "<input type='checkbox' switch='none' data-status='0' id='" . $val->id . "'   onclick='approveuser(this.id)' checked/><label for='" . $val->id . "' data-on-label='On' data-off-label='Off'></label></td>";
                                                        } else {
                                                            echo "<input type='checkbox' switch='none' data-status='1' id='" . $val->id . "'  onclick='approveuser(this.id)'/><label for='" . $val->id . "'  data-on-label='On' data-off-label='Off' ></label></td>";
                                                        }
                                                        echo "</td>";
                                                        echo "<td> <img src=Images/" . $val->sub_image . "  id='image-link' alt='image' class='img-responsive' height=50 width=50></td>";
                                                        echo "<td><a href='" . base_url('add_sub_category/update_sub_category/' . $val->id . '') . "' class='btn btn-primary waves-effect waves-light'>Edit</a> <a href='" . base_url('add_sub_category/delete_sub_categoty/' . $val->id . '') . "' class='btn btn-danger btn_delete' id='" . $val->id . "'>Delete</a></td>";

                                                        echo "</tr>";
                                                        $k++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

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

        <!-- Plugins Init js -->
        <script src="<?php echo base_url() . 'assets/pages/form-advanced.js' ?>"></script>
        <!-- App js -->
        <script src="<?php echo base_url() . 'assets/js/app.js' ?>"></script>
        <script>
            function approveuser(sid) {
                $.ajax({
                    url: "<?php echo base_url() . 'Add_sub_category/change_status' ?>",
                    type: "POST",
                    data: {
                        cid: sid,
                        status: $("#" + sid).data('status')
                    },
                    success: function (data) {
                        window.location.reload();
                    },
                    fail: function () {
                        swal("Error!", "Error while performing operation!", "error");
                    },
                    error: function (data, status, jg) {
                        swal("Error!", data.responseText, "error");
                    }
                });
            }
            //           
        </script>
        <script type="text/javascript">

            function SetForDelete(id) {
                location.href = "Delete.php?type=sub_category&id=" + id;
            }
        </script>
    </body>

</html>
