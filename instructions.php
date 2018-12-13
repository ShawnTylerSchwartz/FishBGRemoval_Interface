<?php 
	include 'snippets/header.php';
	include 'snippets/main.php';
?>

	<h3>Fish Background Removal Instructions.</h3>

	<hr />

	<iframe width="560" height="315" src="https://www.youtube.com/embed/WPxjkd4JkTA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

	<br /><br />
	(1) Use your mouse to click around the edges of the fish, <strong>while avoiding the background of the image</strong>.<br />
	(2) Each point you make will serve to create a <strong>clipping mask</strong> around the fish image.<br /><br />
	<em>Once you have made all the clicks around the edge of the fish, <strong>excluding the background of the fish image,</strong> Click <mark><strong>Execute Background Removal &amp; Upload <i class="fas fa-upload"></i></strong></mark> to continue.</em> 
    <br /><br />Your goal is to have an image that looks like this:
    <br /><br />
    <img src="assets/img/demo-cut-fish.png" width="100%" height="100%" style="padding-bottom: 10px" />

    

<?php
	include 'snippets/footer.php';
?>