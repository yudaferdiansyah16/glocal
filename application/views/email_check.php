<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Smartone, ERP, TPB, PEB, KITE, Manufacturing, Production, Warehouse, Finance">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
	<!-- Call App Mode on ios devices -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Remove Tap Highlight on Windows Phone IE -->
	<meta name="msapplication-tap-highlight" content="no">
	<!-- base css -->
	<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?=assets_url('css/vendors.bundle.css')?>">
	<link id="appbundle" rel="stylesheet" media="screen, print" href="<?=assets_url('css/vendors.bundle.css')?>">
	<link id="myskin" rel="stylesheet" media="screen, print" href="<?=assets_url('css/skins/skin-master.css')?>">
	<!-- Place favicon.ico in the root directory -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?=assets_url('img/favicon/apple-touch-icon.png')?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=assets_url('img/favicon/favicon-32x32.png')?>">
	<link rel="mask-icon" href="<?=assets_url('img/favicon/safari-pinned-tab.svg')?>" color="#5bbad5">
	<link rel="stylesheet" media="screen, print" href="<?=assets_url('css/page-login-alt.css')?>">
	<link rel="stylesheet" media="screen, print" href="<?= assets_url('css/notifications/toastr/toastr.css') ?>">
</head>
<!-- BEGIN Body -->
<!-- Possible Classes

    * 'header-function-fixed'         - header is in a fixed at all times
    * 'nav-function-fixed'            - left panel is fixed
    * 'nav-function-minify'			  - skew nav to maximize space
    * 'nav-function-hidden'           - roll mouse on edge to reveal
    * 'nav-function-top'              - relocate left pane to top
    * 'mod-main-boxed'                - encapsulates to a container
    * 'nav-mobile-push'               - content pushed on menu reveal
    * 'nav-mobile-no-overlay'         - removes mesh on menu reveal
    * 'nav-mobile-slide-out'          - content overlaps menu
    * 'mod-bigger-font'               - content fonts are bigger for readability
    * 'mod-high-contrast'             - 4.5:1 text contrast ratio
    * 'mod-color-blind'               - color vision deficiency
    * 'mod-pace-custom'               - preloader will be inside content
    * 'mod-clean-page-bg'             - adds more whitespace
    * 'mod-hide-nav-icons'            - invisible navigation icons
    * 'mod-disable-animation'         - disables css based animations
    * 'mod-hide-info-card'            - hides info card from left panel
    * 'mod-lean-subheader'            - distinguished page header
    * 'mod-nav-link'                  - clear breakdown of nav links

    >>> more settings are described inside documentation page >>>
-->

<body>
<script>
	'use strict';

	var classHolder = document.getElementsByTagName("BODY")[0],
			themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
			themeURL = themeSettings.themeURL || '',
			themeOptions = themeSettings.themeOptions || '';

</script>
<div class="blankpage-form-field">
	<div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4"
		 style="background-color: #00003F">
		<a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center"
		   style="padding: 20px !important;">
			<img src="<?=assets_url('img/logo3.png')?>" height="50" alt="Smartone" aria-roledescription="logo">
		</a>
	</div>
	<div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
		<div class="text-center mb-4">
			<h4><?=getAppSetting($this)->nama_sbu?></h4>
		</div>

		<form method="post" action="<?=base_url('Gfp/index')?>">
			<div class="form-group">
				<input type="email"  class="form-control" id="email" name="email" placeholder="Email" autocomplete="false">
			</div>
			<button type="submit" class="btn btn-info float-md-right">Submit</button>
			<a href="<?=base_url('login/signin')?>" class="btn btn-info float-md-left">Back</a>
		</form>
	</div>
</div>
<video poster="<?=assets_url('img/backgrounds/clouds.png')?>" id="bgvid" playsinline autoplay muted loop>
	<source src="<?=assets_url('media/video/cc.webm')?>" type="video/webm">
	<source src="<?=assets_url('media/video/cc.mp4')?>" type="video/mp4">
</video>
<!-- base vendor bundle:
 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
			+ pace.js (recommended)
			+ jquery.js (core)
			+ jquery-ui-cust.js (core)
			+ popper.js (core)
			+ bootstrap.js (core)
			+ slimscroll.js (extension)
			+ app.navigation.js (core)
			+ ba-throttle-debounce.js (core)
			+ waves.js (extension)
			+ smartpanels.js (extension)
			+ src/../jquery-snippets.js (core) -->
<script src="<?=assets_url('js/vendors.bundle.js')?>"></script>
<script src="<?=assets_url('js/app.bundle.js')?>"></script>
<script src="<?= assets_url('js/notifications/toastr/toastr.js') ?>"></script>
<!-- Page related scripts -->
</body>
<!-- END Body -->

</html>
