<?php
	$directory = $_GET['dir'];
	$dir_split = explode("/", $directory);
	$fam_only = $dir_split[1];
	$images = glob($directory . "*.png");

	$zipFileName = $fam_only . ".zip";
	$zip = new ZipArchive;
	$zip->open($zipFileName, ZipArchive::CREATE);

	foreach($images as $img) {
		$zip->addFile($img);
	}
        
	$zip->close();

	if(file_exists($zipFileName)){
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($zipFileName)) . ' GMT');
		header('Content-Type: application/force-download');
		header('Content-Disposition: inline; filename='.$zipFileName);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($zipFileName));
		header('Connection: close');
		readfile($zipFileName);
		unlink($zipFileName);
		exit();
	}
?>

<script>window.close();</script>