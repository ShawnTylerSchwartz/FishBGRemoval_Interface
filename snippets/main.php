<?php
  //
  // By Shawn Tyler Schwartz <shawnschwartz@ucla.edu>
  // https://shawntylerschwartz.com
  // (c) Alfaro Lab UCLA 2018
  //
?>

<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      		<a class="navbar-brand" href="index.php"><i class="fas fa-fish"></i> Fish BG Removal</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      		</button>

      		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
        		<ul class="navbar-nav mr-auto">
          			<li class="nav-item active">
            			<a class="nav-link" href="index.php">Reset Interface <span class="sr-only">(current)</span></a>
          			</li>
                <li class="nav-item">
                  <a class="nav-link" href="instructions.php" target="_blank">Instructions</a>
                </li>
    			  </ul>
    </nav>
    <main class="container">
   	 		<p></p>
   	 		<br /><br /><br />
        <h2>Fish Image Clipping Interface</h2>

        <div class="alert alert-warning" id="chromeWarningMessage" role="alert" style="visibility: hidden; display: none;">
          <i class="fas fa-exclamation-triangle"></i> WARNING: This interface is designed to work in the <a href="https://www.google.com/chrome/browser/" target="_blank" class="alert-link">Google Chrome Web Browser [Download Here]</a>. At the moment, other web browsers will not work properly. Thank you.
        </div>
        
        <!-- Check if Browser is Google Chrome for Warning Message Display -->
        <script>
          // Opera 8.0+
          var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

          // Firefox 1.0+
          var isFirefox = typeof InstallTrigger !== 'undefined';

          // Safari 3.0+ "[object HTMLElementConstructor]" 
          var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

          // Internet Explorer 6-11
          var isIE = /*@cc_on!@*/false || !!document.documentMode;

          // Edge 20+
          var isEdge = !isIE && !!window.StyleMedia;

          // Chrome
          var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
          
          if (isOpera || isFirefox || isSafari || isIE || isEdge) {
            document.getElementById("chromeWarningMessage").style.visibility = "visible";
            document.getElementById("chromeWarningMessage").style.display = "block";
            console.log("Browser is Identified as Google Chrome?.. " + isChrome);
          } else if (isChrome) {
            document.getElementById("chromeWarningMessage").style.visibility = "hidden";
            document.getElementById("chromeWarningMessage").style.display = "none";
            console.log("Browser is Identified as Google Chrome?.. " + isChrome);
          }
        </script>
