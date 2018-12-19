<?php
	session_start();

	include 'snippets/header.php';
	include 'snippets/main.php';
?>

<p class="lead"><i class="fas fa-file-download"></i> Download BG Removed Fish Samples by Family. <br />
	<strong>Click a family</strong> to download the <mark>background removed</mark> samples.</p>

<?php
	// define function getAllDirs
	// (return first level img directories)
	function getAllDirs($directory, $directory_seperator) {
		$dirs = array_map(function ($item) use ($directory_seperator) {
    		return $item . $directory_seperator;
		}, array_filter(glob($directory . '*'), 'is_dir'));

		foreach ($dirs as $dir) {
    		$dirs = array_merge($dirs, getAllDirs($dir, $directory_seperator));
		}
	
		return $dirs;
	}

	// path to directory to scan 
	$directory = "fish_output/";
 	$directory_seperator = "/";

 	$alldirs = getAllDirs($directory, $directory_seperator);

 	// print all directories with links for downloads
 	echo "<ul class='list-group'>";
 	foreach($alldirs as $dir) {
 		$directory = $dir;
 		$dir_split = explode("/", $dir);
 		$fam_only = $dir_split[1];
 		$images = glob($directory . "*.png");

 		$numImgs = count($images);
 		echo "<a href='generate_fish_zip.php?dir=" . $dir . "'target='_blank'>";
 			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
 				echo "<i class='fas fa-file-archive'></i>" . $dir; 
 				echo "<span class='badge badge-primary badge-pill'>";
 					echo $numImgs;
 				echo "</span>";
 			echo "</li>";
 		echo "</a>";
 		echo "<div style='margin-bottom: 10px;'></div>";
 	}
 	echo "</ul>";