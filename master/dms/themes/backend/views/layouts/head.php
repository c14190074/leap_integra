<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="#">
    <title><?= Snl::app()->config()->site_title ?></title>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Menu CSS -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet"> -->

    <!-- //////////////// NEW TEMPLATE //////////////////////// -->
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= Snl::app()->config()->theme_url ?>assets_soft/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= Snl::app()->config()->theme_url ?>assets_soft/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= Snl::app()->config()->theme_url ?>assets_soft/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= Snl::app()->config()->theme_url ?>assets_soft/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- ///////////////// END OF NEW TEMPLATE /////////////////// -->


    <!-- /////////// PLUGINS ///////////////////// -->
    <!-- alerts CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- js grid -->
    <link type="text/css" rel="stylesheet" href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jsgrid2/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jsgrid2/jsgrid-theme.min.css" />

    <!-- toast CSS -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
    <!-- Select -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <!-- Fancyapps -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/fancybox-master/dist/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
    <!-- Date picker plugins css -->
    <link href="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Datetime Picker -->
    <link rel="stylesheet" type="text/css" href="<?= Snl::app()->config()->theme_url ?>plugins/datetimepicker/jquery.datetimepicker.css">
    <!-- /////// END OF PLUGINS ///////////////  -->


    <!-- animation CSS -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/css/animate.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/css/style.css" rel="stylesheet"> -->
    <!-- color CSS -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/css/colors/default.css" id="theme" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    


    <!-- Local Custom -->
    <!-- <link href="<?= Snl::app()->config()->theme_url ?>assets/css/local.css" rel="stylesheet"> -->
    <link href="<?= Snl::app()->config()->theme_url ?>assets/css/local2.css" rel="stylesheet">
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Jquery UI -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jquery-ui/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/js/waves.js"></script>
    <!-- Sweet-Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <!-- Fancyapps  -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/fancybox-master/dist/jquery.fancybox.min.js"></script>
    <!-- JS-Grid  -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jsgrid2/jsgrid.min.js"></script>
    <!--Counter js -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    
    <!-- chartist chart -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- Datetime Picker -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/datetimepicker/jquery.datetimepicker.full.js"></script>

    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/tinymce/tinymce.min.js"></script>

    <!-- Sparkline chart JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Select -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>

    <!-- Touch Punch -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/touch-punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/js/cbpFWTabs.js"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>ampleadmin-minimal/js/custom.min.js"></script>
    <!-- <script src="ampleadmin-minimal/js/dashboard1.js"></script> -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="<?= Snl::app()->config()->theme_url ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
    <script>
        var baseUrl = "<?= Snl::app()->baseUrl() ?>";
        var pageSize = 10;
    </script>
</head>

<body class="g-sidenav-show  bg-gray-100">

<!-- Preloader -->
<div class="preloader hidden">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- End Preloader -->
