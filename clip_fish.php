<?php 
	session_start();

	include 'snippets/header.php';
	include 'snippets/main.php';

	$current_image = $_GET['image'];
?>

<script>
/*
 * Adapted by Shawn Tyler Schwartz from original author: netplayer@gmx.com on Github
 */

$(document).ready(function() {

    var condition = 1;
    var points = []; //holds the mousedown points
    var canvas = document.getElementById('fishCanvas');
    this.isOldIE = (window.G_vmlCanvasManager);

    // Set Empty Vars for Original Fish Image Dimensions
    var oriFishWidth = 0;
    var oriFishHeight = 0;

    $(function() {

        if (this.isOldIE) {
        	G_vmlCanvasManager.initElement(fishCanvas);
        }

        var ctx = canvas.getContext('2d');
        var imageObj = new Image();

        function init() {
            canvas.addEventListener('mousedown', mouseDown, false);
            canvas.addEventListener('mouseup', mouseUp, false);
            canvas.addEventListener('mousemove', mouseMove, false);
        }

	    // Draw  image onto the canvas
	    imageObj.onload = function() {
	        ctx.drawImage(imageObj, 0, 0);
	    };
	    imageObj.src = "<?php echo $current_image; ?>";

	    // Set Vars for Original Fish Image Dimensions
        oriFishWidth = imageObj.width;
        oriFishHeight = imageObj.height;

        document.getElementById("fishCanvas").width = oriFishWidth;
        document.getElementById("fishCanvas").height = oriFishHeight;

        // Switch the blending mode
        ctx.globalCompositeOperation = 'destination-over';

        //mousemove event
        $('#fishCanvas').mousemove(function(e) {
            if (condition == 1) {
                ctx.beginPath();

                $('#posx').html(e.offsetX);
                $('#posy').html(e.offsetY);
            }
        });
        //mousedown event
        $('#fishCanvas').mousedown(function(e) {
            if (condition == 1) {
                if (e.which == 1) {
                    var pointer = $('<span class="spot">').css({
                        'position': 'absolute',
                        'background-color': '#000000',
                        'width': '5px',
                        'height': '5px',
                        'top': e.pageY,
                        'left': e.pageX
                    });
                    
                    //store the points on mousedown
                    points.push(e.pageX, e.pageY);

                    console.log(points);

                    ctx.globalCompositeOperation = 'destination-out';
                    var oldposx = $('#oldposx').html();
                    var oldposy = $('#oldposy').html();
                    var posx = $('#posx').html();
                    var posy = $('#posy').html();
                    ctx.beginPath();
                    ctx.moveTo(oldposx, oldposy);
                    if (oldposx != '') {
                        ctx.lineTo(posx, posy);

                        ctx.stroke();
                    }
                    $('#oldposx').html(e.offsetX);
                    $('#oldposy').html(e.offsetY);
                }
                $(document.body).append(pointer);
                $('#posx').html(e.offsetX);
                $('#posy').html(e.offsetY);
            } //condition
        });

        $('#crop').click(function() {
            condition = 0;

            //  var pattern = ctx.createPattern(imageObj, "repeat");
            //ctx.fillStyle = pattern;
            $('.spot').each(function() {
                $(this).remove();

            })
            //clear canvas

            //var context = canvas.getContext("2d");

            ctx.clearRect(0, 0, oriFishWidth, oriFishHeight);
            ctx.beginPath();
            ctx.width = oriFishWidth;
            ctx.height = oriFishHeight;

            ctx.globalCompositeOperation = 'destination-over';
            //draw the polygon
            setTimeout(function() {

            //console.log(points);
            var offset = $('#fishCanvas').offset();
            //console.log(offset.left,offset.top);

            for (var i = 0; i < points.length; i += 2) {
                var x = parseInt(jQuery.trim(points[i]));
                var y = parseInt(jQuery.trim(points[i + 1]));


                if (i == 0) {
                    ctx.moveTo(x - offset.left, y - offset.top);
                } else {
                    ctx.lineTo(x - offset.left, y - offset.top);
                }
                //console.log(points[i],points[i+1])
            }

            // $("#serverSendButton").prop('disabled', false);
            $("#crop").prop('disabled', true);

            if (this.isOldIE) {

                ctx.fillStyle = '';
                ctx.fill();
                var fill = $('fill', fishCanvas).get(0);
                fill.color = '';
                fill.src = element.src;
                fill.type = 'tile';
                fill.alignShape = false;
            } else {
                var pattern = ctx.createPattern(imageObj, "repeat");
                ctx.fillStyle = pattern;
                ctx.fill();

                var dataurl = canvas.toDataURL("image/png");

                //upload to server (if needed)
                var xhr = new XMLHttpRequest();
                // // 
                xhr.open('POST', 'execute_clip.php?image=<?php echo $current_image; ?>', false);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var files = dataurl;
                var data = new FormData();
                var myprod = $("#pid").val();
                data = 'image=' + files;
                xhr.send(data);
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    $('#myimg').html('<img src="upload/' + xhr.responseText + '.png"/>');
                    alert("Fish subsample has been successfully saved! Resetting interface...");
                    close();
                    window.open("fish_list.php?<?php echo SID; ?>");
                }
            }
        }, 20);
    	});
	});
});

</script>
	<div class="alert alert-warning" role="alert">
		Currently removing the background for <strong><?php echo $current_image; ?></strong>
	</div>

	<button type="button" class="btn btn-lg btn-success" onClick="window.location.reload()">
		<i class="fas fa-cloud-download-alt"></i> Load-In &amp; Set Current Fish
	</button>

	<br /><br />

	<!-- Buttons for triggering modals -->
	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#instructionsModal">
	  <i class="fas fa-ruler"></i> Fish BG Removal Instructions
	</button>

	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#schematicModal">
	  <i class="fas fa-video"></i> Example BG Clipping Video
	</button>

	<button type="button" class="btn btn-danger" onClick="window.location.reload()">
	  <i class="fas fa-undo"></i> Try Again
	</button>

	<!-- Subscaling Modal Instructions -->
	<div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="instructionsModalTitle"><i class="fas fa-ruler"></i> Fish BG Removal Instructions</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			(1) Use your mouse to click around the edges of the fish, <strong>while avoiding the background of the image</strong>.<br />
			(2) Each point you make will serve to create a <strong>clipping mask</strong> around the fish image.<br /><br />
			<em>Once you have made all the clicks around the edge of the fish, <strong>excluding the background of the fish image,</strong> Click <mark><strong>Execute Background Removal &amp; Upload <i class="fas fa-upload"></i></strong></mark> to continue.</em> 
            <br /><br />Your goal is to have an image that looks like this:
            <br /><br />
            <img src="assets/img/demo-cut-fish.png" width="100%" height="100%" style="padding-bottom: 10px" />
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- SL Schematic Example Modal Instructions -->
	<div class="modal fade" id="schematicModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="schematicModalTitle"><i class="fas fa-video"></i> Example BG Clipping Video</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<iframe width="100%" height="315" src="https://www.youtube.com/embed/WPxjkd4JkTA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- JS Below for Modal -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

	<p></p>
	<div id="cropButton"></div>
	<p></p>

	<!-- <div class='clickable' id='clicker'>
		<span class='display'></span>
		<img src="<?php echo $current_image; ?>" id="fishSample" width="100%" height="100%" />
	</div> -->
	<div class="container">
		<canvas id="fishCanvas" style="position: relative; margin-left: 0px; margin-top: 0px;"></canvas>
	</div>

	<br />
	<button type="button" id="crop" class="btn btn-success btn-lg">
   		Execute Background Removal &amp; Upload <i class="fas fa-upload"></i>
	</button>

	<!--<button type="submit" id="serverSendButton" class="btn btn-success btn-lg" disabled>
   		Send to Server <i class='fas fa-upload'></i>
	</button> -->

	<div id="oldposx" style="display:none;"></div>
	<div id="oldposy" style="display:none;"></div>
	<div id="posx" style="display:none;"></div>
	<div id="posy" style="display:none;"></div>