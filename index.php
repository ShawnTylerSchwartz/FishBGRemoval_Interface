<?php
	session_start();

	include 'snippets/header.php';
	include 'snippets/main.php';
?>

<div class="alert alert-success" role="alert">
  <strong>UPDATES: Sunday, January 13, 2019</strong>
  	<br /><br />
  	1) The distribution of fish images has now been more streamlined for your convenience. You will no longer need to return to a list of fish after each background is removed. <br />Instead, after you click <mark><strong><i class="fas fa-upload"></i> Crop Fish</strong></mark>, the <mark><strong>Ready? Next Fish <i class="fas fa-forward"></i></strong></mark> button will take you directly to the next fish image. A preview of the next fish will accompany this button as well.
  	<br /><br />
  	2) Fish images are now automatically preloaded into the background removal interface. Therefore, the <mark><strong style="text-decoration: line-through;"><i class="fas fa-cloud-download-alt"></i> Display Fish</strong></mark> has been replaced <br />with <mark><strong><i class="fas fa-exclamation-circle"></i> No Fish? Reload.</strong></mark> in the event of a display error.
  	<br /><br />
  	&dash; Shawn Schwartz
  	<br />[Please email <strong>shawnschwartz@ucla.edu</strong> for any bugs/issues. Thank you.]
</div>

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
  		If you are a returning participant, you should use the same identifier each time. <strong>Your email address or chosen unique identifier will not be stored</strong>.
  		<br /><br />
		For any questions regarding the interface, please email <strong>shawnschwartz@ucla.edu</strong> with the subject line [Fish Interface]. Thank you.
	</div>

<?php include 'snippets/footer.php'; ?>