<?php
session_start();

include 'userinfo.php';

// if(isset($_SESSION['username'])) {
//     header('Location: index.php');
// }

$_SESSION['verifiedUser'] = false;

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    $_SESSION['verifiedUser'] = false;
    // header('Location: ' . $_SERVER['PHP_SELF']);

    header('Location: login.php');
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['verifiedUser'] = true;
        header('Location: index.php');
    } else {
        //Invalid Login
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
        <link href="assets/css/footer.css" rel="stylesheet">

        <!-- HTML2Canvas JS -->
        <script src="assets/js/html2canvas.min.js"></script>

        <!-- Jcrop CSS and JS -->
        <link rel="stylesheet" href="assets/css/jquery.Jcrop.min.css" type="text/css" />
        <script src="assets/js/jquery.Jcrop.min.js"></script>

        <!-- Fontawesome CSS CDN -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link href="../assets/css/signin.css" rel="stylesheet">
    <head>

    <body>
        
      <!--  <form name="login" action="" method="post">
            Username:  <input type="text" name="username" value="" /><br />
            Password:  <input type="password" name="password" value="" /><br />
            <input type="submit" name="submit" value="Submit" />
        </form>-->




  <body class="text-center">
    <form class="form-signin" name="login" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-fish"></i> Fish SL Subsamples Admin Panel</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; <a href="https://michaelalfaro.github.io/alfaro-lab/" target="_blank">The Alfaro Lab</a> UCLA 2018 <br /> by <a href="https://shawntylerschwartz.com" target="_blank">Shawn T. Schwartz</a></p>
    </form>
  </body>
</html>
