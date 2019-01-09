<?php 
		
		if (isset($_POST['cont']) and !empty($_POST['cont'])) {$num_contra = maxout($_POST['cont']);} else {$num_contra = 8;}
		if (isset($_POST['event']) and !empty($_POST['event'])) {$num_adverse = maxout($_POST['event']);} else {$num_adverse = 8;}
		if (isset($_POST['warn']) and !empty($_POST['warn'])) {$num_warn = maxout($_POST['warn']);} else {$num_warn = 8;}
		

?>
<!doctype html>
<?php
		
		?>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Pharmageddon<?php if(isset($brandname)) {
			echo " – " . $brandname;
		}?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Social Media Meta-->
<!-- Facebook -->
<meta property="og:title" content="Pharmageddon">
<meta property="og:type" content="website" />
<meta property="og:description" content="Randomly-generated fictional medicine.">
<meta property="og:image" content="http://jamesmarchment.com/pharmageddon/img/title_preview.jpg">
<meta property="og:url" content="http://jamesmarchment.com/pharmageddon/">
<!-- Twitter -->
<meta name="twitter:title" content="Pharmageddon">
<meta name="twitter:description" content="Randomly-generated fictional medicine.">
<meta name="twitter:image" content="http://jamesmarchment.com/pharmageddon/img/tw_preview.jpg">
<meta name="twitter:card" content="summary_large_image">
		
		
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
<link rel="icon" type="image/x-icon" href="./favicon.ico" />
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/pharmageddon.css">
		<link href="https://fonts.googleapis.com/css?family=Oswald:200,300" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
		<link href='https://fonts.googleapis.com/css?family=Economica:400,700' rel='stylesheet' type='text/css'>
        <!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->
		
		

    </head>
    <body>
	<div id="loader"></div>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div id="wrapper">
		<?php 
		
		$size = array('sm','md','lg');
		$shape  = array('round','oval','square','capsule');
		$fill  = array('mono','dicot');
		$alphabet = array('a','b','c','d','e','f','g','h','i','j');		
		$n = 30;
		foreach ($alphabet as $a) {
			echo '<div id="pill_' . $a . '1" class="pill ' . $size[array_rand($size)] . " " . $shape[array_rand($shape)] . " " . $fill[array_rand($fill)] . '" style="top: 30px; left: ' . $n . '%;"><span></span></div>';	
			$n += 4;
		}
		$n = 30;
		foreach ($alphabet as $a) {
			echo '<div id="pill_' . $a . '2" class="pill ' . $size[array_rand($size)] . " " . $shape[array_rand($shape)] . " " . $fill[array_rand($fill)] . '" style="top: 85px; left: ' . $n . '%;"><span></span></div>';	
			$n += 4;
		}
		$n = 30;
		foreach ($alphabet as $a) {
			echo '<div id="pill_' . $a . '3" class="pill ' . $size[array_rand($size)] . " " . $shape[array_rand($shape)] . " " . $fill[array_rand($fill)] . '" style="top: 140px; left: ' . $n . '%;"><span></span></div>';	
			$n += 4;
		}
		
		
		?>
	
        <div id="content">
		<div id="topslab" class="wall"></div>
		<div id="instructions">Click & drag to move objects!<br><img src="./img/arrow.svg"></div>
		<h1 class="cloak">Pharmageddon</h1>
		<div style="position: relative;">
		<img id="title1" class="title" src="./img/title_opac_animate.png">
		<img id="title2" class="title" src="./img/title_opac100.png"></div>
		<hr id="titlespacer" >
		<div id="settings" class="settings-switch"></div>
		<div id="settings-modal">
		<div id="close" class="settings-switch"></div>
		<h4>Settings</h4>
		<form action="index.php" method="post">
<p>contraindications</p>
<input type="text" class="quant" name="cont" placeholder="#" autocomplete="off" value="<?php if (isset($_POST['cont']) and !empty($_POST['cont'])) {echo $num_contra;} else {} ?>">
<p>adverse events</p>
<input type="text" class="quant" name="event" placeholder="#" autocomplete="off" value="<?php if (isset($_POST['event']) and !empty($_POST['event'])) {echo $num_adverse;} else {} ?>">
<p>precautions</p>
<input type="text" class="quant" name="warn" placeholder="#" autocomplete="off" value="<?php if (isset($_POST['warn']) and !empty($_POST['warn'])) {echo $num_warn;} else {} ?>"><br>

<input type="submit" value="Prescribe" id="submit-button">
</form>

		
		</div>
		<!--end header>-->