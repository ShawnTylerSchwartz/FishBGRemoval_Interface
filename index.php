<?php
	session_start();

	include 'snippets/header.php';
	include 'snippets/main.php';
?>

<p class="lead">Please enter your <strong>email</strong> or a <strong>unique identifier</strong> below to get started.</p>

 <!-- <form class="form-signin text-center" name="login" action="fish_list.php?" method="post"> -->


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
	$directory = "fish_input/";
 	$directory_seperator = "/";

	$alldirs = getAllDirs($directory, $directory_seperator);
 	
 	// print each file name into list with link to next-level of image directory
 	foreach($alldirs as $dir) {

 		//path to directory to scan
		$directory = $dir;
 
		//get all image files with a .jpg extension.
		$images = glob($directory . "*.jpg");

		$block = 1024*1024; //1MB for file read in
		$tmpstorage = array();
		if ($fh = fopen("_outputData.html", "r")) { 
    		$left='';
    		while (!feof($fh)) { // read in file
       			$temp = fread($fh, $block);  
       			$fgetslines = explode("<hr />",$temp);
       			$fgetslines[0]=$left.$fgetslines[0];
       			if(!feof($fh) )$left = array_pop($lines);           
       				foreach ($fgetslines as $k => $line) {
		       			$completedComponents = explode(",", $line);
						array_push($tmpstorage, $completedComponents[0]);
	       			}
       		} 	
		}

		fclose($fh); // close file stream

		$numCompleted = 0;

		foreach ($images as $image) {
			if (in_array($image, $tmpstorage)) {
				$numCompleted++;
			} else {
				break;
			}

			$totalNumImgs = count($images);
			// printf($totalNumImgs);

			$percentCompleted = (($numCompleted+1) / $totalNumImgs) * 100;
			$numRemaining = $totalNumImgs - ($numCompleted);
			
			if ($numCompleted != 0) {
				$percentCompleted = (($numCompleted) / $totalNumImgs) * 100;
				$numRemaining = $totalNumImgs - ($numCompleted);
			} else {
				$percentCompleted = 0;
				$numRemaining = $totalNumImgs - ($numCompleted);
			}
		}

		// printf($numCompleted);
		// printf($numRemaining);
		// printf($percentCompleted);

	/*	echo "<ul class='list-group'>";
  			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
    			echo "<a href='view_dir.php?dir=" . $dir . "'>" . $dir . "</a>";
    			/*if($numRemaining == 0) {echo "<span class='badge badge-success badge-pill'><i class='fas fa-star'></i> $numRemaining</span>";} else { echo "<span class='badge badge-danger badge-pill'><i class='fas fa-star-half-alt'></i> $numRemaining</span>"; }
    			if($percentCompleted == 100) { echo "<span class='badge badge-success badge-pill'>$percentCompleted%</span>"; } else { echo "<span class='badge badge-primary badge-pill'>$percentCompleted%</span>"; }*/
  		/*	echo "</li>";
  			echo "<div style='margin-bottom: 10px;'></div>";
		echo "</ul>"; */


 	}
?>

<?php
	function ListFiles($dir) {
	    if($dh = opendir($dir)) {
	        $files = Array();
	        $inner_files = Array();
	        while($file = readdir($dh)) {
	            if($file != "." && $file != ".." && $file[0] != '.') {
	                if(is_dir($dir . "/" . $file)) {
	                    $inner_files = ListFiles($dir . "/" . $file);
	                    if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
	                } else {
	                    array_push($files, $dir . "/" . $file);
	                }
	            }
	        }
	        closedir($dh);
	        shuffle($files);

	        return $files;
	    }
	}

	// $remainingFish: To be used for random session assignment to users
	$allFish = ListFiles('fish_input');
	$completedFish = $tmpstorage;
	$remainingFish = array_merge(array_diff($allFish, $completedFish), array_diff($completedFish, $allFish));

	$selectedFish = array_slice($remainingFish, 0, 10);


	/*foreach (ListFiles('fish_input') as $key=>$file){
	    echo '<pre>'; print_r($file); echo '</pre>';
	}*/
?>

<?php
	// Initialize the array
	$files = array();

	$files = $selectedFish;
	$_SESSION['FISHFILES'] = $files;

	// echo session_id();
	// echo '<a href="test.php?' . SID . '" target="_blank">test page</a>';
?>

 	<?php echo '<form class="form-signin text-center" name="login" action="fish_list.php?' . SID . '" method="post">'; ?>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputUsername" name="emailaddress" class="form-control" placeholder="Email Address or Unique Identifier" required autofocus>
      <p></p>
      <button class="btn btn-primary text-center" id="view-fullscreen" type="submit" name="submit" value="Submit">Launch Interface <i class="fas fa-rocket"></i></button>
    </form>

    <p></p>

    <div class="alert alert-info" role="alert">
  		<i class="fas fa-info-circle"></i> This login information will only be used to identify which images were processed by the same person in statistical analyses.
  		<br /><br />
  		If you are a returning participant, you should use the same identifier each time.
  		<br /><br />
		For any questions regarding the interface, please email <strong>shawnschwartz@ucla.edu</strong> with the subject line [Fish Interface]. Thank you.
	</div>

<?php include 'snippets/footer.php'; ?>