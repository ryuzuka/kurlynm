<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="HZF7o0mS0lBAuD-oULDNf1L_zgoZq1ZoY4LfZDi0cdE" />
    <title><?=$pageTitle?></title>

        <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
        <link id="favicon" rel="icon" type="image/x-icon" href="/images/favicon.ico">
        
    <link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/slick-1.6.0/slick/slick.css">
	<link rel="stylesheet" href="/css/slick-1.6.0/slick/slick-theme.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/sub00.css">


    <script src="/js/jquery.min.js"></script>
    <!--<script src="/js/slick.min.js"></script>-->
	<script src="/js/slick.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>

    <script src="/js/common.js"></script>

    <?php if ($this->session->flashdata('message')) { ?>
    <script type="text/javascript"> alert('<?=$this->session->flashdata('message')?>'); </script>
    <?php } ?>
  </head>
  <body>
    <div class="dim-layer"></div>
    <div class="wrap">

        <!-- Header -->
        <?php $this->load->view('front/include/header'); ?>

        
      
        <!-- Main -->
        <?php $this->load->view($pageName); ?>

        

        <!-- Footer -->
        <?php $this->load->view('front/include/footer'); ?>

        <!-- go top -->
        <?php $this->load->view('front/include/gotop'); ?>

      
    </div>
  </body>
</html>
