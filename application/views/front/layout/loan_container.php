<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>One Shot</title>
        <!-- Tell the browser to be responsive to screen width -->
        <!--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/static/bower_components/bootstrap/dist/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/static/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/static/bower_components/Ionicons/css/ionicons.min.css">

        <!-- Morris chart -->
        <link rel="stylesheet" href="/static/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="/static/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="/static/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="/static/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="/static/plugins/iCheck/minimal/_all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="/static/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="/static/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="/static/bower_components/select2/dist/css/select2.min.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="/static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="/static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="/static/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        <link rel="stylesheet" href="/static/dist/css/skins/skin-blue.min.css">
             folder instead of downloading all of them to reduce the load. -->
        <!--link rel="stylesheet" href="/static/dist/css/skins/_all-skins.min.css"-->
        <link rel="stylesheet" href="/static/dist/css/skins/skin-acc.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!-- jQuery 3 -->
        <script src="/static/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/static/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="/static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- jvectormap -->
        <script src="/static/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/static/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

        <!-- Select2 -->
        <script src="/static/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="/static/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="/static/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="/static/plugins/input-mask/jquery.inputmask.extensions.js"></script>

        <!-- date-range-picker -->
        <script src="/static/bower_components/moment/min/moment.min.js"></script>
        <script src="/static/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="/static/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="/static/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="/static/plugins/timepicker/bootstrap-timepicker.min.js"></script>

        <!-- DataTables -->
        <script src="/static/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- Slimscroll -->
        <script src="/static/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="/static/plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="/static/bower_components/fastclick/lib/fastclick.js"></script>

        <!-- Bootstrap WYSIHTML5 -->
        <script src="/static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

        <!-- ChartJS -->
        <script src="/static/bower_components/chart.js/Chart.js"></script>
        <!-- Morris.js charts -->
        <script src="/static/bower_components/raphael/raphael.min.js"></script>
        <script src="/static/bower_components/morris.js/morris.min.js"></script>
        <!-- FLOT CHARTS -->
        <script src="/static/bower_components/Flot/jquery.flot.js"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="/static/bower_components/Flot/jquery.flot.resize.js"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="/static/bower_components/Flot/jquery.flot.pie.js"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="/static/bower_components/Flot/jquery.flot.categories.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="/static/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- Sparkline -->
        <script src="/static/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- fullCalendar -->
        <script src="/static/bower_components/moment/moment.js"></script>

        <!-- AdminLTE App -->
        <script src="/static/dist/js/adminlte.js"></script>
        <!-- Development -->
        <script src="/static/js/common.js"></script>

        <!-- Development -->
        <link rel="stylesheet" href="/static/dist/css/common.css">
        
        <!-- GOOGLE WEB FONTS INCLUDE -->
        <link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,600' rel='stylesheet' type='text/css'>
    
        <style>
            body { max-width: 420px; min-width: 360px; margin: 0 auto; font-family: "Nanum Gothic";  }
            .header { position: relative; left: 0; top: 0; height: 60px; }
            
            
            #btn-back { width: 40px; height: 60px; display: block; position: absolute; top: 1%; left: 2%; float: left; }
            #btn-menu { width: 40px; height: 60px; display: block; position: absolute; top: 1%; left: 88%; }
            
            #btn-sns { width: 50%; height: 50px; display: block; position: absolute; top: 98%; left: 0; }
            #btn-cert { width: 50%; height: 50px; display: block; position: absolute; top: 98%; left: 50%; }
            
            #btn-myinfo { width: 50%; height: 50px; display: block; position: absolute; top: 98%; left: 0; }
            #btn-myloan { width: 50%; height: 50px; display: block; position: absolute; top: 98%; left: 50%; }
            
            .menu-wrap { /*background-image: url(/images/loan/menu.png); background-size: cover; background-repeat: no-repeat;*/ display: none; position: absolute; top: 0; left: 500px; width: 50%; height: 100vh; background-color: #004579;}
            .menu { position: relative; }
            
            #btn-close { width: 40px; height: 40px; display: block; position: absolute; top: 0; left: 78%; }
            
            #btn-home { width: 100%; height: 9%; display: block; position: absolute; top: 50%; left: 0; }
            #btn-product { width: 100%; height: 9%; display: block; position: absolute; top: 59%; left: 0; }
            #btn-mypage { width: 100%; height: 9%; display: block; position: absolute; top: 68%; left: 0; }
            #btn-loan { width: 100%; height: 9%; display: block; position: absolute; top: 77%; left: 0; }
    
            .dim { opacity: 0.4; background-color: #000; }
        </style>
        
        <?php if ($this->session->flashdata('message')) { ?>
            <script type="text/javascript"> alert('<?= $this->session->flashdata('message') ?>');</script>
        <?php } ?>
    </head>
    <body class="hold-transition skin-acc sidebar-mini">

        <div class="wrapper">
            <div class="header">
                <div style="position: relative; width: 100%; height: 100%">
                    <img src="/images/loan/header_<?=$pageTitle?>.png" style="width: 100%;">
                    
                    <a id="btn-back" href="#"></a>
                    <a id="btn-menu" href="#"></a>
                    
                    <?php if($pageTitle == "loginsns" || $pageTitle == "logincert") { ?>
                    <a id="btn-sns" href="#"></a>
                    <a id="btn-cert" href="#"></a>
                    <?php } ?>
                    
                    <?php if($pageTitle == "myinfo" || $pageTitle == "myloan") { ?>
                    <a id="btn-myinfo" href="#"></a>
                    <a id="btn-myloan" href="#"></a>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Main content -->
            <section class="content">
                <?php $this->load->view($pageName); ?>
            </section>
            <!-- /.content -->

        </div>
        <!-- ./wrapper -->


        <div class="menu-wrap">
            <div class="menu">
                <img src="/images/loan/menu.png" style="width: 100%;">
                
                <a id="btn-close" href="#"></a>
            
                <a id="btn-home" href="#"></a>
                <a id="btn-product" href="#"></a>
                <a id="btn-mypage" href="#"></a>
                <a id="btn-loan" href="#"></a>
            </div>
        </div>

<script type="text/javascript">
    //$('.calendar').datepicker({format: 'dd-mm-yyyy', todayHighlight: true});
    $(document).on('click focus', '#btn-back', function() {
        event.preventDefault();

        window.history.back();
    });
    
    $(document).on('click', '#btn-menu', function () {
        var wMW = window.screen.width;
        var wMH = window.screen.height;
 
        $("body").css("height", wMH);
        
        $('.menu-wrap').show();
        $(".menu-wrap").animate({
            left: "50%"
        });
        
        $('.wrapper').addClass("dim");
        
        $('html').css("overflow","hidden");
        $('html').css("position","fixed");
    });
    
    $(document).on('click', '#btn-close', function () {
        $('.menu-wrap').animate({ 
            left: '500px'
        }, 500, function() { $('.menu-wrap').hide(); });
        
        $('.wrapper').removeClass("dim");
    });
    
    $(document).on('click focus', '#btn-home', function(){
        location.href = "/loan";
    });
    
    $(document).on('click focus', '#btn-product', function(){
        location.href = "product_list";
    });
    
    $(document).on('click focus', '#btn-mypage', function(){
        location.href = "my_info";
    });
    
    $(document).on('click focus', '#btn-loan', function(){
        location.href = "my_loan";
    });
    
    $(document).on('click focus', '#btn-sns', function(){
        location.href = "login_sns";
    });
    
    $(document).on('click focus', '#btn-cert', function(){
        location.href = "login_cert";
    });
    
    $(document).on('click focus', '#btn-myinfo', function(){
        location.href = "my_info";
    });
    
    $(document).on('click focus', '#btn-myloan', function(){
        location.href = "my_loan";
    });
</script>


</body>
</html>
