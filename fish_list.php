<?php
	session_start();

	include 'snippets/header.php';
	include 'snippets/main.php';

	$userEmail = $_POST['emailaddress'];
	$seshID = session_id();

	$date   = new DateTime();
	$readableDate = $date->format('m-d-Y,h:i:sa');

	$userLookupAddress = "_userLookup.html";

	$fhstream = fopen($userLookupAddress, 'a'); 
	// $userLookupAddress=$userEmail .','. $seshID . ',' . $readableDate . '<hr />'; 
    $userLookupAddress=$seshID . ',' . $readableDate . '<hr />'; 
	fwrite($fhstream,$userLookupAddress); // Write information to the file
	fclose($fhstream); // Close the file 

?>

<!-- <h4>Welcome <?php echo $userEmail; ?>!</h4> -->
<p class="lead">Please click <mark>Get Started <i class='fas fa-forward'></i></mark> to begin removing backgrounds for fish.</strong>
    <ul>
        <li>Further <strong>instructions</strong> &amp; <strong>tutorials</strong> may be viewed by <a href="instructions.php" target="_blank">clicking here</a> or during your session as pop-over menus for your reference.</li>
    </ul>
    <!-- <ul> -->
        <!-- <li>Please click each button to complete the process for each fish.</li> -->
        <!-- <li>When you're finished with one fish, you will be returned to this list.</li> -->
        <!-- <li>Green buttons represent completed fish.</li> -->
        <!-- <li><em>Note: If a button is already green, it has been completed by someone else sometime between you starting today.</em></li> -->
    <!-- </ul> -->
    <!-- If you do not finish your assigned batch, the <strong>uncompleted fish</strong> will be recycled back for someone else to complete.<br /> -->
    <!-- <mark>If you have <strong>completed</strong> your assigned fish, click <a href="index.php">Reset Interface</a> and <strong>re-enter</strong> your <strong>email</strong> to start a new fish session.</mark> -->
</p>

<?php
    //path to directory to scan
        $directory = $_GET['dir'];
     
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
    //print_r($allFish);
    $completedFish = $tmpstorage;
    $remainingFish = array_merge(array_diff($allFish, $completedFish), array_diff($completedFish, $allFish));

    $selectedFish = array_slice($remainingFish, 0, 10);


    // Initialize the array
    $files = array();

    $files = $selectedFish;
    $_SESSION['FISHFILES'] = $files;

    $assignedFishFiles = $_SESSION['FISHFILES'];
    
    echo "<div class='container'>";
        echo "<div class='row'>";
            echo "<div class='col-sm-4'></div>";
            echo "<div class='col-sm-4'>";
                echo "<div class='card text-center' style='width: 18rem;'>";
                    echo "<img class='card-img-top' src='" . $assignedFishFiles[0] . "'>";
                    echo "<div class='card-body'>";
                        echo "<a href='clip_fish.php?image=" . $assignedFishFiles[0] . '&' . SID . "' class='btn btn-primary'>Get Started <i class='fas fa-forward'></i></a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "<div class='col-sm-4'></div>";
        echo "</div>";
    echo "</div>";

        $numCompleted = 0;

        foreach ($assignedFishFiles as $image) {

            /*
            if (in_array($image, $tmpstorage)) {
                echo "<div class='list-group' style='display: none; visibility: hidden;'>";
                    echo "<a href='clip_fish.php?image=" . $image . '&' . SID . "' class='list-group-item list-group-item-action list-group-item-success'>" . $image . "</a><div style='margin-bottom: 10px;'></div></li>";
                echo "</div>";
                    $numCompleted++;
            } else {
                echo "<div class='list-group'>";
                    echo "<a href='clip_fish.php?image=" . $image . '&' . SID . "' class='list-group-item list-group-item-action list-group-item-danger'>" . $image . "</a><div style='margin-bottom: 10px;'></div></li>";
                    echo "</div>";
            }*/

            /*

            $totalNumImgs = count($assignedFishFiles);

            if ($numCompleted != 0) {
                $percentCompleted = (($numCompleted) / $totalNumImgs) * 100;
                $numRemaining = $totalNumImgs - ($numCompleted);
            } else {
                $percentCompleted = 0;
                $numRemaining = $totalNumImgs - ($numCompleted);
            }
            */

        }

        /*
        echo "<div class='progress' style='height: 35px; margin-top: 25px;'>";
            echo "<div class='progress-bar' role='progressbar' style='font-size: 16px; font-weight: bolder; width: $percentCompleted%;'>$percentCompleted %</div>";
        echo "</div>";
        echo "<p class='lead'><em>Current progress...<strong>your percentage of fishes scaled and cropped</strong> for this current session.</em></p>";
        */
        echo "<a href='index.php'><button type='button' class='btn btn-secondary'><i class='far fa-arrow-alt-circle-left'></i> Back to Login Screen</button></a><br /><br />";
?>

<?php include 'snippets/footer.php'; ?>