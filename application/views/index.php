<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-s1.11.3.min.js"></script> -->
    <script src="<?php echo base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/vendors/sweetalert/sweetalert.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->

    <link href="<?php echo base_url('assets') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><img src="<?php echo base_url(); ?>assets/production/images/logo_pcr.png" alt="" width="150px" height="50px"></a>
                    </div>

                    <div class="clearfix"></div>
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php echo $this->session->userdata('full_name') ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <!-- <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li> -->
                                    <li><a href="#" onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <!-- <li role="presentation" class="dropdown">
                                <a href="" class="dropdown-toggle bg-blue">
                                    <i class="fa fa-television"></i>
                                    System Log
                                </a>
                            </li> -->
                            <li role="presentation" class="dropdown">
                                <a href="" class="dropdown-toggle bg-orange">
                                    <i class="fa fa-refresh"></i>
                                    Reload
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main" id='pageContent'>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <img src="<?php echo base_url('assets/production/images/banner_pcr.jpg') ?>" class="col-md-12 col-sm-12 col-xs-12" alt="">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <br />
                <div class="row">
                    <?php foreach ($listVideo as $row) { ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel tile fixed_height_320">
                                <div class="x_content">
                                    <div class="widget_summary">
                                        <iframe width="500" height="315" src="https://www.youtube.com/embed/<?php echo $row->url ?>" frameborder="0" allowfullscreen></iframe>
                                        <br>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Arniuz Global Asia <a href="https://fitraarrafiq@gmail.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/') ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/') ?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets/') ?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets/') ?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/') ?>vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('assets/') ?>vendors/skycons/skycons.js"></script>
    <!-- Sweetalert -->
    <script src="<?php echo base_url('assets') ?>/vendors/sweetalert/sweetalert.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('assets/') ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('assets/') ?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/') ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/') ?>build/js/custom.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '<?php echo base_url('Administrator/sideBar'); ?>',
                type: 'GET',
                async: true,
                dataType: 'JSON',
                responsive: true,
                success: function(data) {
                    // console.log(data.html);
                    $('#sidebar-menu').html(data.html);
                }
            })
        });
        // Please don't edit/change this configuration
        // Contact Developer to add/change

        function underMaintenance() {
            swal({
                title: "This config is under development !",
                icon: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            })
        }

        function menu(url) {
            var url;
            $.ajax({
                url: '<?php echo base_url('Administrator/'); ?>' + url,
                type: 'GET',
                async: true,
                dataType: 'JSON',
                beforeSend: function(data) {
                    // document.title = 'Please wait....';
                },
                success: function(data) {
                    $('#pageContent').html(data.html);
                    document.title = data.title;
                },
                error: function() {
                    $.ajax({
                        url: '<?php echo base_url('Administrator/errorPages'); ?>',
                        type: 'GET',
                        async: true,
                        dataType: 'JSON',
                        success: function(data) {
                            underMaintenance();
                            $('#pageContent').html(data.html);
                            $('#title').html(data.title);
                        },
                    })

                    // $('#pageContent').html('Oops ! <br>Page Not Found, Error <br><br><br> Please Contact Administrator !');

                    document.title = 'Page Not Found';
                }
            })
        }
    </script>
    <script type="text/javascript">
        function logout() {
            swal({
                title: "Do you want to logout ?",
                icon: "warning",
                // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                text: "Click yes if you have been finished all the transactions in this system ",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }).then(function() {
                $.ajax({
                    url: "<?php echo site_url('auth/logout'); ?>",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(data) {
                        $url = '<?php echo base_url('/auth/') ?>';
                        setTimeout(() => {
                            $(location).attr('href', $url)
                        }, 1400);
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error to Log out, check the connection or configuration !');
                    }
                });
            });
        }
    </script>
</body>

</html>