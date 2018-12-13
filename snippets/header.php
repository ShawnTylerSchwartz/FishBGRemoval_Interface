<?php
	//
	// By Shawn Tyler Schwartz <shawnschwartz@ucla.edu>
	// https://shawntylerschwartz.com
	// (c) Alfaro Lab UCLA 2018
	//
?>

<!-- FishColorPattern_Interface for Subsampling Scaled Fish Images -->
<!-- (c) Alfaro Lab UCLA 2018 -->
<!-- By Shawn Tyler Schwartz <shawnschwartz@ucla.edu> -->
<!-- https://shawntylerschwartz.com -->

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Standard Length Subsampling Interface for Coral Reef Fish Color Patterns">
		<meta name="author" content="Shawn Tyler Schwartz">

		<title>Fish Subsampling Interface</title>

		<!-- Bootstrap Core CSS CDN -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- Bootstrap Core JS CDN -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- Popper.js CDN -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<!-- Jquery JS CDN -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

		<!-- Sticky Footer CSS -->
		<link href="assets/css/footer.css" rel="stylesheet">

		<!-- HTML2Canvas JS -->
		<script src="assets/js/html2canvas.min.js"></script>

		<!-- Jcrop CSS and JS -->
		<link rel="stylesheet" href="assets/css/jquery.Jcrop.min.css" type="text/css" />
  		<script src="assets/js/jquery.Jcrop.min.js"></script>

  		<!-- Fontawesome CSS CDN -->
  		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	  	<style>
			body {
				padding-left: 10px;
				padding-right: 10px;
			}

			.clickable {
				margin: 15px;
				position: absolute;
				display: flex;
				justify-content: center;
				cursor: crosshair;
			}

			.display {
				display: block;
				height: 16px;
				position: absolute;
				text-align: center;
				vertical-align: middle;
				width: 100%;
				top: -5%;
				margin-top: -8px;
				font-weight: bold;
			}
	  	</style>
	</head>