<!DOCTYPE html>
<html>
<head>
	<!-- META :BEGIN -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- META :END -->

	<meta name="theme-color" content="#0065F2">
	<meta name="msapplication-navbutton-color" content="#0065F2">
	<meta name="apple-mobile-web-app-status-bar-style" content="#0065F2">

	<title>N Compass</title>
	<script>var BASE_URL="<?= base_url(); ?>";</script>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/new_layout/css/bootstrap.min.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/new_layout/css/sf-ui-font.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/new_layout/css/waves.min.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/new_layout/css/custom.css');?>" />
	<link rel=stylesheet href="<?= base_url('public/styles/validationEngine.jquery.css');?>">
</head>
<body>
<?= $this->renderSection('content'); ?>
<script type="text/javascript" src="<?= base_url('public/new_layout/js/jquery-3.4.1.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/new_layout/js/popper.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/new_layout/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/new_layout/js/waves.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/new_layout/js/custom.js');?>"></script>
	<script src="<?= base_url('public/js/alljs.js');?>"></script>
	<script src="<?= base_url('public/js/validate/jquery.validationEngine.js');?>"></script>
</body>
</html>