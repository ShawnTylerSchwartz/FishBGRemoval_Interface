<?php
session_start();

if(($_SESSION['username'] === '') || (($_SESSION['verifiedUser'] === false) && ($_SESSION['verifiedUser'] !== ''))) {
    header('Location: login.php');
}

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    $_SESSION['verifiedUser'] = false;
    header('Location: login.php');
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    } else {
        // Invalid Login Attempt
        echo "<script>alert('The username and password you have entered are incorrect. Try again!')</script>";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Standard Length Subsampling Interface for Coral Reef Fish Color Patterns">
        <meta name="author" content="Shawn Tyler Schwartz">

        <title>Fish Admin Panel</title>

        <!-- Bootstrap Core CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Bootstrap Core JS CDN -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- Popper.js CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Jquery JS CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <!-- Sticky Footer CSS -->
        <link href="../assets/css/footer.css" rel="stylesheet">

        <!-- HTML2Canvas JS -->
        <script src="../assets/js/html2canvas.min.js"></script>

        <!-- Jcrop CSS and JS -->
        <link rel="stylesheet" href="../assets/css/jquery.Jcrop.min.css" type="text/css" />
        <script src="../assets/js/jquery.Jcrop.min.js"></script>

        <!-- Fontawesome CSS CDN -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.php"><i class="fas fa-fish"></i> Fish BG Removal Admin Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">&laquo; Return to Main Interface <span class="sr-only">(current)</span></a>
                    </li>
                    <a href="reports.php">
                        <button class="btn btn-secondary" type="button">
                            <i class="fas fa-table"></i> Generate Reports 
                        </button>
                    </a>
                    &nbsp;
                    <a href="../download_fish.php" target="_blank">
                        <button class="btn btn-secondary" type="button">
                            <i class="fas fa-file-download"></i> Download BG Removed Fish 
                        </button>
                    </a>
                  </ul>
                  <a href="?logout=1"><button class="btn btn-danger my-2 my-sm-0">Logout</button></a>
            </div>
        </nav>
        <main class="container">
            <p></p><p></p>
            <br /><br /><br />
            <h2>Administrator Interface</h2>
            <?php if($_SESSION['username']): ?>
                <p>You are logged in as <?=$_SESSION['username']?></p>
            <?php endif; ?>

            <p class="lead">Click on a directory below to get started.</p>

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
                $directory = "../fish_input/";
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
                    if ($fh = fopen("../_outputData.html", "r")) { 
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

                    echo "<ul class='list-group'>";
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                            echo "<a href='view_dir.php?dir=" . $dir . "'>" . $dir . "</a>";
                        echo "</li>";
                        echo "<div style='margin-bottom: 10px;'></div>";
                    echo "</ul>";

                }
            ?>

    <?php include '../snippets/footer.php'; ?>