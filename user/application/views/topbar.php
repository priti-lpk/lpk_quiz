<html>

    <head>
        <base href="http://localhost/lpk-quiz/user">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link href="<?php echo base_url() . 'assets/plugins/select2/css/select2.min.css' ?>" rel="stylesheet" type="text/css" />
    </head>
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="<?php echo base_url('Index') ?>" class="logo">
                <span>
                    <img src="<?php echo base_url() . 'logo/logo-1.png' ?>" alt="" height="64">
                </span>
                <i>
                    <img src="<?php echo base_url() . 'logo/logo-1.png' ?>" alt="" height="62">
                </i>
            </a>
        </div>

        <nav class="navbar-custom">
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li> 
                <li class="float-left">
                    <div class="user1">                        
                        <?php
                        echo '<span style="font-size: 20px;">' . $this->session->userdata('user_name') . '</span>';
                        ?>
                    </div>
                    <!--</button>-->
                </li>  
            </ul>

        </nav>

    </div>

