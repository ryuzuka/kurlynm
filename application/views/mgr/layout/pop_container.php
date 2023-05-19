<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Administrator</title>
		<!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap -->
        <link href="/static/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="/static/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="/static/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link rel="stylesheet" href="/static/plugins/iCheck/all.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/static/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/static/css/skins/_all-skins.min.css">
        
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="/static/plugins/iCheck/all.css" rel="stylesheet" type="text/css">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.1.4 -->
		<script src="/static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/static/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/static/js/app.min.js"></script>
        <!-- InputMask -->
        <script src="/static/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="/static/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="/static/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- CK Editor -->
        <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- DatePicker -->
        <script src="/static/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- iCheck -->
        <script src="/static/plugins/iCheck/icheck.min.js"></script>
        
        <link rel="stylesheet" href="/static/css/resume.css">

		<?php if ($this->session->flashdata('message')) { ?>
		<script type="text/javascript"> alert('<?=$this->session->flashdata('message')?>'); </script>
		<?php } ?>
        
	</head>
	<body class="">
        <form id="hiddenForm" name="hiddenForm" method="post" action="" style="display: none;"></form>
        <iframe id="ifrm" name="ifrm" src="about:blank" frameborder="0" scrolling="no" style="width: 100%; height: 200px; display: none;"></iframe>
        
		<!-- header logo: style can be found in header.less -->
		<header class="header">
            <a href="#" class="logo" style='width:100%;'>
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
            </a>
		</header>
		<!-- Main -->
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="margin-left:0; background-color: #FFFFFF;">
				<?php $this->load->view($pageName); ?>
			</aside>
		</div>
	</body>
</html>
